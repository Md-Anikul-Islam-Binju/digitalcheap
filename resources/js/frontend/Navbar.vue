<template>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Thirteenth navbar example">
            <div class="container">
                <div class="d-flex d-lg-none align-items-center justify-content-between w-100">
                    <Link class="navbar-brand d-inline d-lg-none" href="/">
                        <img :src="getLogoUrl(siteSettings?.logo)" style="width: 120px;" alt="">
                    </Link>
                    <div class="d-flex gap-3 align-items-center">
                        <Link class="cart-icon position-relative d-block d-lg-none text-dark" style="width: 30px;">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">{{totalCartCount}}</span>
                            <svg xmlns="http://www.w3.org/2000/svg"  width="30"  height="30"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                        </Link>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </div>

                <div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
                    <a class="navbar-brand me-0 mt-2 mt-lg-0 d-none d-lg-block" href="/">
                        <img :src="getLogoUrl(siteSettings?.logo)" alt="" style="height: 60px;" class="logo-img">
                    </a>
                    <ul class="navbar-nav mx-auto justify-content-lg-center">
                        <li class="nav-item">
                            <Link class="nav-link active" aria-current="page" href="/">Home</Link>
                        </li>

                        <li class="nav-item">
                            <Link class="nav-link fw-semibold" href="/products">
                                Pricing
                            </Link>
                        </li>
                        <li class="nav-item" v-if="authUser">
                            <a href="/dashboard" target="_blank" class="btn btn-success">
                                {{ authUser.name.split(' ')[0] + '...' }}
                            </a>
                        </li>

                        <div class="nav-item d-lg-flex" v-else>
                            <li class="nav-item">
                                <a href="#" class="nav-link" @click.prevent="openLoginModal">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-nowrap" href="#" @click.prevent="openRegistrationModal">Sign Up</a>
                            </li>
                        </div>
                    </ul>

                    <div class="d-lg-flex d-flex flex-wrap justify-content-lg-end align-items-center gap-2 mt-1 mt-lg-0">

                        <form role="search" @submit.prevent="searchProduct" class="form-width">
                            <input class="form-control" type="search" v-model="searchQuery" placeholder="Search" aria-label="Search">
                        </form>
                        <Link class="btn btn-outline-success mt-2 mt-lg-0" href="/how-to-become-affiliate">Affiliate</Link>
                        <!-- <a class="btn btn-success mt-2 mt-lg-0" href="/chatify">Live Chat</a>-->
                        <a href="#" class="btn btn-success mt-2 mt-lg-0" @click.prevent="openLoginModal">Live Chat</a>
                        <div class="currency-width shadow-none">
                            <select class="form-select shadow-none rounded border-success" aria-label="Default select example">
                                <option selected>USD</option>
                                <option value="1">EUR</option>
                                <option value="2">INR</option>
                            </select>
                        </div>
                        <div class="cart-icon position-relative d-none d-lg-block" style="width: 30px;">
                            <Link href="/cart">
                                 <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">{{totalCartCount}}</span>
                                 <svg xmlns="http://www.w3.org/2000/svg"  width="30"  height="30"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>



</template>
<script>
import Swal from "sweetalert2";

export default {
    name: "Navbar",
    props: {
        siteSettings: Object,
        cart : Array,
        authUser: Object
    },
    data() {
        return {
            loginForm: {
                email: "",
                password: "",
                remember: false,
            },
            searchQuery: '',
            passwordVisible: false,
            csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    computed: {
        totalCartCount() {
            // Calculates the total cart count dynamically
            return this.cart.reduce((total, item) => total + (item.quantity || 1), 0);
        },
    },

    methods:{

        searchProduct() {
            // Use Inertia to redirect to the search page with the search query
            if (this.searchQuery) {
                this.$inertia.get('/search', { q: this.searchQuery });  // Inertia redirect
            }
        },

        loginWithGoogle() {
            window.location.href = '/login/google'; // Redirect to the Laravel route handling Google login
        },

        togglePasswordVisibility() {
            this.passwordVisible = !this.passwordVisible;
            const passwordInput = document.getElementById("password");
            if (passwordInput) {
                passwordInput.type = this.passwordVisible ? "text" : "password";
            }
        },
        getLogoUrl(logoPath) {
            if (!logoPath) {
                return 'default-logo.png';
            }
            return `${window.location.origin}/${logoPath}`;
        },
        openLoginModal() {
            Swal.fire({
                title: "Login",
                html: `
                    <form id="login-form">
                        <div class="form-floating mb-3">
                            <input type="email" id="email" class="form-control" placeholder="name@example.com" required>
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" id="password" class="form-control" placeholder="Password" required>
                            <label for="password">Password</label>
                            <span id="toggle-password" class="position-absolute" style="top: 50%; right: 8px; transform: translateY(-50%); cursor: pointer;">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                              <circle cx="12" cy="12" r="3"></circle>
                            </svg>

                            </span>
                        </div>


                        <a href="/forgot-password" class="mb-3">Forgot password?</a>

                        <button type="button" id="login-button" class="btn btn-success w-100">Login</button>

                        <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
                        <hr class="my-4">
                        <h2 class="fs-5 fw-bold mb-3">Or use a third-party</h2>

                        <button id="google-login" class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48px" height="30px">
                                <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                                <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                                <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                                <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                            </svg>
                            Sign up with Google
                        </button>
                    </form>
                `,
                showCloseButton: true, // Enables the close button
                closeButtonHtml: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
                showConfirmButton: false,
                allowOutsideClick: false,
                didOpen: () => {
                    const togglePassword = document.getElementById("toggle-password");
                    if (togglePassword) {
                        togglePassword.addEventListener("click", this.togglePasswordVisibility);
                    }

                    // Bind Google login button inside SweetAlert modal
                    const googleLoginButton = document.getElementById("google-login");
                    if (googleLoginButton) {
                        googleLoginButton.addEventListener("click", this.loginWithGoogle);
                    }
                },


            });

            // Add click event listener to the login button
            setTimeout(() => {
                const loginButton = document.getElementById("login-button");
                if (loginButton) {
                    loginButton.addEventListener("click", this.handleLogin);
                }
            }, 100);
        },

        async handleLogin() {
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            try {
                const response = await axios.post("/login", { email, password });
                if (response.status === 200) {
                    Swal.fire({
                        icon: "success",
                        title: "Login Successful",
                        text: "Redirecting to dashboard...",
                        timer: 2000,
                        showConfirmButton: false,
                    }).then(() => {
                        location.reload(); // Reload to reflect the login state
                    });
                }
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    Swal.fire({
                        icon: "error",
                        title: "Login Failed",
                        text: "Invalid email or password. Please try again.",
                        confirmButtonText: "OK",
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something went wrong. Please try again later.",
                        confirmButtonText: "OK",
                    });
                }
            }
        },

        // Open Registration Modal
        openRegistrationModal() {
            Swal.fire({
                title: "Register",
                html: `
                    <form id="registration-form">
                        <div class="form-floating mb-3">
                            <input type="text" id="name" class="form-control" placeholder="Your Name" required>
                            <label for="name">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" id="email" class="form-control" placeholder="name@example.com" required>
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" id="password" class="form-control" placeholder="Password" required>
                            <label for="password">Password</label>
                            <span id="toggle-password" class="position-absolute" style="top: 50%; right: 8px; transform: translateY(-50%); cursor: pointer;">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                              <circle cx="12" cy="12" r="3"></circle>
                            </svg>

                        </div>
                        <button type="button" id="register-button" class="btn btn-success w-100">Register</button>
                    </form>

                      <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
                        <hr class="my-4">
                        <h2 class="fs-5 fw-bold mb-3">Or use a third-party</h2>
                       <button id="google-login" class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48px" height="30px">
                                <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                                <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                                <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                                <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                            </svg>
                            Sign up with Google
                        </button>
                `,
                showCloseButton: true,
                showConfirmButton: false,
                allowOutsideClick: false,
                didOpen: () => {
                    const togglePassword = document.getElementById("toggle-password");
                    if (togglePassword) {
                        togglePassword.addEventListener("click", this.togglePasswordVisibility);
                    }

                    // Bind Google login button inside SweetAlert modal
                    const googleLoginButton = document.getElementById("google-login");
                    if (googleLoginButton) {
                        googleLoginButton.addEventListener("click", this.loginWithGoogle);
                    }


                },
            });

            setTimeout(() => {
                const registerButton = document.getElementById("register-button");
                if (registerButton) {
                    registerButton.addEventListener("click", this.handleRegistration);
                }
            }, 100);
        },


        async handleRegistration() {
            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            // Define the value of is_registration_by explicitly
            const is_registration_by = "User"; // or dynamically set this value if needed
            try {
                const response = await axios.post("/account-registration", { is_registration_by, name, email, password });

                if (response.status === 200) {
                    Swal.fire({
                        icon: "success",
                        title: "Registration Successful",
                        text: "A verification email has been sent to your address.",
                        timer: 3000,
                        showConfirmButton: false,
                    });

                    // Automatically open the verification modal after registration
                    setTimeout(() => {
                        this.openVerificationModal();
                    }, 3000); // Wait 3 seconds before showing the verification modal (to allow the success alert to close)
                }
            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Registration Failed",
                    text: "Please check the details and try again.",
                    confirmButtonText: "OK",
                });
            }
        },

        // Open Verification Modal
        openVerificationModal() {
            Swal.fire({
                title: "Verify Your Email",
                html: `
                    <form id="verification-form">
                        <div class="form-floating mb-3">
                            <input type="text" id="verification-code" class="form-control" placeholder="Verification Code" required>
                            <label for="verification-code">Verification Code</label>
                        </div>
                        <button type="button" id="verify-button" class="btn btn-success w-100">Verify</button>
                    </form>
                `,
                showCloseButton: true,
                showConfirmButton: false,
                allowOutsideClick: false,
            });

            setTimeout(() => {
                const verifyButton = document.getElementById("verify-button");
                if (verifyButton) {
                    verifyButton.addEventListener("click", this.handleVerification);
                }
            }, 100);
        },

        async handleVerification() {
            const verificationCode = document.getElementById("verification-code").value;

            try {
                const response = await axios.post("/account-verify-complete", { verification_code: verificationCode });

                if (response.status === 200) {
                    Swal.fire({
                        icon: "success",
                        title: "Verification Successful",
                        text: response.data.message,
                        timer: 2000,
                        showConfirmButton: false,
                    }).then(() => {
                        window.location.href = '/'; // Redirect to the dashboard
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Verification Failed",
                    text: error.response?.data?.message || 'An error occurred. Please try again.',
                }).then(() => {
                    this.openVerificationModal();
                });
            }
        }

    },
    mounted() {
        console.log("Cart data:", this.authUser);
        console.log("Auth User:", this.authUser);

        $(document).ready(function () {
            // Close navbar when clicking a nav-link
            $(".navbar-nav .nav-link").on("click", function () {
                $(".navbar-collapse").collapse("hide");
            });

            // Close navbar when clicking outside
            $(document).on("click", function (event) {
                var $navbar = $(".navbar");
                var $navbarCollapse = $(".navbar-collapse");

                if (!$navbar.is(event.target) && $navbar.has(event.target).length === 0) {
                    $navbarCollapse.collapse("hide");
                }
            });
        });

    }
}
</script>
<style scoped>

</style>
