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

<!--                            <li class="nav-item">-->
<!--                                <Link class="nav-link" href="/login" target="_blank">Login</Link>-->
<!--                            </li>-->

                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
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
                        <a class="btn btn-outline-success mt-2 mt-lg-0 ">Affiliate</a>

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

    <!-- login modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-5 pt-0">
                    <form @submit.prevent="loginUser" action="/login" method="POST">
                        <input type="hidden" name="_token" :value="csrfToken">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" v-model="loginForm.email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" v-model="loginForm.password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>

                        <div class="form-check text-start my-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Remember me
                            </label>
                        </div>
                        <a href="/forgot-password" class="mb-3">Forgot password?</a>

                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-success" type="submit">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Login Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You have successfully logged in. Click "OK" to go to your dashboard.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" @click="redirectToDashboard">OK</button>
                </div>
            </div>
        </div>
    </div>


</template>
<script>
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
        loginUser(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': this.csrfToken,
                },
                body: formData,
            })
                .then(response => {
                    console.log('Response Status:', response.status);
                    console.log('Response Headers:', response.headers);

                    // Log the response text to understand its content
                    return response.text().then(text => {
                        console.log('Response Body:', text); // Log the response body
                        if (text.includes("<!DOCTYPE html>")) {
                            throw new Error("Unexpected HTML response: Likely redirected to login page");
                        }

                        // Parse JSON only if it's valid
                        return JSON.parse(text);
                    });
                })
                .then(data => {
                    if (data.success) {
                        $('#successModal').modal('show');
                    } else {
                        alert(data.message || 'Login failed. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Login error:', error);
                    alert(error.message || 'An unexpected error occurred. Please try again.');
                });
        },





        redirectToDashboard() {
            window.location.href = '/dashboard'; // Redirect to dashboard after success
        },


    },
    mounted() {
        console.log("Cart data:", this.authUser);
    }
}
</script>
<style scoped>

</style>
