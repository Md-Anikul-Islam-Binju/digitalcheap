<template>
    <title>Affiliate</title>
    <br><br>
    <section class="py-8">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 col-12">
                    <!-- text center -->
                    <div class="text-center">
                        <h4 class="display-4 fw-bold">How to Join Become  a Affiliate</h4>
                        <p class="lead px-8">Read our terms below to learn more about your rights and responsibilities as a Product Name user.</p>
                        <a href="#" class="btn btn-success mt-2 mt-lg-0" @click.prevent="openLoginModal">Join Affiliate</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 col-12">
                    <!-- text center -->
                    <div  class="text-center">
                        <iframe class="w-100" width="560" height="460" :src="getEmbeddedYouTubeUrl(siteSettings.how_to_join_become_affiliate_link)" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-8">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="d-flex mt-5">
                        <div class="ms-3">
                            <p class="fs-4 mb-4" v-html="siteSettings.how_to_join_become_affiliate"> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br>
</template>

<script>
import Layout from "../frontend/Layout.vue";
import Swal from "sweetalert2";

export default {
    name: "AffiliateJoin",
    layout: Layout,
    props: {
        siteSettings: Object,
        authUser: Object,
        cart : Array,
    },

    data() {
        return {
            loginForm: {
                email: "",
                password: "",
                remember: false,
            },
            passwordVisible: false,
            csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    methods:{

        getEmbeddedYouTubeUrl(link) {
            if (!link) return ''; // Return an empty string if link is not available

            const videoIdMatch = link.match(/(?:youtu\.be\/|youtube\.com\/(?:.*v=|embed\/|v\/|.*[?&]v=))([^?&]+)/);
            const videoId = videoIdMatch ? videoIdMatch[1] : null;

            return videoId ? `https://www.youtube.com/embed/${videoId}` : '';
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
    }


}
</script>

<style scoped>

</style>
