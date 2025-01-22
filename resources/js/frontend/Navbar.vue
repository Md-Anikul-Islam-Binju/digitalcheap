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
                    <a class="navbar-brand col-lg-2 me-0 mt-2 mt-lg-0 d-none d-lg-block" href="/">
                        <img :src="getLogoUrl(siteSettings?.logo)" alt="" style="height: 60px;" class="logo-img">
                    </a>

                    <ul class="navbar-nav mx-auto justify-content-lg-center">
                        <li class="nav-item">
                            <Link class="nav-link active" aria-current="page" href="/">Home</Link>
                        </li>

                        <li class="nav-item">
                            <Link class="nav-link" href="/products">Product</Link>
                        </li>

                        <li class="nav-item" v-if="authUser">
                            <a href="/dashboard" target="_blank" class="btn btn-success">{{ authUser.name }}</a>
                        </li>


                        <div class="nav-item d-lg-flex" v-else>

                            <li class="nav-item">
                                <a href="#" class="nav-link" @click.prevent="openLoginModal">Login</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-nowrap" href="/account-registration-for-user" target="_blank">Sign Up</a>
                            </li>
                        </div>
                    </ul>

                    <div class="d-lg-flex d-flex flex-wrap justify-content-lg-end align-items-center gap-2 mt-1 mt-lg-0">
                        <form role="search" class="form-width">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        </form>
                        <Link class="btn btn-outline-success mt-2 mt-lg-0" href="/how-to-become-affiliate">Affiliate</Link>

                        <a class="btn btn-success mt-2 mt-lg-0" href="/chatify">Live Chat</a>

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
                        <div class="form-floating mb-3">
                            <input type="password" id="password" class="form-control" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>


                        <a href="/forgot-password" class="mb-3">Forgot password?</a>

                        <button type="button" id="login-button" class="btn btn-success w-100">Login</button>

                                                <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
                        <hr class="my-4">
                        <h2 class="fs-5 fw-bold mb-3">Or use a third-party</h2>

                        <button class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit">
                            <svg class="bi me-1" width="16" height="16">
                                <use xlink:href="#github"></use>
                            </svg>
                            Sign up with Google
                        </button>
                    </form>
                `,
                showCloseButton: true, // Enables the close button
                closeButtonHtml: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
                showConfirmButton: false,
                allowOutsideClick: false,
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





    },
    mounted() {
        console.log("Cart data:", this.authUser);
        console.log("Auth User:", this.authUser);
    }
}
</script>
<style scoped>

</style>
