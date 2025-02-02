<script>
import Layout from "../frontend/Layout.vue";
import Swal from "sweetalert2";

export default {
    name: "ProductDetails",
    layout: Layout,
    props: {
        product: Object,
        allProduct: Array,
        auth: Boolean, // Auth status passed from backend
        authUser: Object, // Auth user data passed from backend
    },
    data() {
        return {
            duration: 1, // Default duration (months)
            deviceAccess: 1, // Default device access
            passwordVisible: false,
        };
    },
    computed: {
        baseUrl() {
            return window.location.origin;
        },
        totalPrice() {
            const basePrice = this.product.discount_amount || this.product.amount; // Use discount price if available
            return basePrice * this.duration * this.deviceAccess;
        },
    },
    methods: {
        togglePasswordVisibility() {
            this.passwordVisible = !this.passwordVisible;
            const passwordInput = document.getElementById("password");
            if (passwordInput) {
                passwordInput.type = this.passwordVisible ? "text" : "password";
            }
        },
        getProductImageUrl(productImagePath) {
            if (!productImagePath) {
                return `${this.baseUrl}/frontend/images/file.jpg`; // Fallback image
            }
            return `${this.baseUrl}/images/product/${productImagePath}`;
        },
        updateDuration(value) {
            this.duration = Math.max(1, Math.min(this.duration + value, 12)); // Limit between 1 and 12
        },
        updateDeviceAccess(value) {
            this.deviceAccess = Math.max(1, Math.min(this.deviceAccess + value, 2)); // Limit between 1 and 2
        },
        addToCart(event, product) {
            event.preventDefault();

            if (!this.auth) {
                this.promptLogin(); // Prompt login if the user is not authenticated
                return;
            }

            const data = {
                product_id: product.id,
                name: product.name,
                price: product.discount_amount || product.amount, // Use discount price if available
                duration: this.duration,
                device_access: this.deviceAccess,
            };

            axios.post('/cart/add', data)
                .then((response) => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.data.message || 'Product added to cart successfully!',
                        confirmButtonText: 'OK',
                    });
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An unexpected error occurred.',
                        confirmButtonText: 'OK',
                    });
                });
        },
        promptLogin() {
            Swal.fire({
                title: "Login Required",
                html: `
                <div>
                   <form id="login-form">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" id="email" placeholder="name@example.com">
                          <label for="email">Email address</label>
                        </div>

                        <div class="form-floating mb-3">
                          <input type="password" class="form-control" id="password" placeholder="Password">
                          <label for="password">Password</label>
                          <span id="toggle-password" class="position-absolute" style="top: 50%; right: 8px; transform: translateY(-50%); cursor: pointer;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                              <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                          </span>
                        </div>

                        <div class="form-check text-start my-3">
                          <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            Remember me
                          </label>
                        </div>

                        <a href="#" class="mb-3">Forgot password?</a>
                        <button type="button" id="login-button" class="w-100 mb-2 btn btn-lg rounded-3 btn-success">Sign In</button>
                        <hr class="my-4">
                        <h2 class="fs-5 fw-bold mb-3">Or use a third-party</h2>
                        <button class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit">
                           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48px" height="30px">
                              <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                              <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                              <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                              <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                            </svg>
                            Sign up with Google
                        </button>
                   </form>
                </div>
                `,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    const togglePassword = document.getElementById("toggle-password");
                    if (togglePassword) {
                        togglePassword.addEventListener("click", this.togglePasswordVisibility);
                    }
                },
            });

            setTimeout(() => {
                const loginButton = document.getElementById("login-button");
                if (loginButton) {
                    loginButton.addEventListener("click", () => {
                        const email = document.getElementById("email").value;
                        const password = document.getElementById("password").value;

                        axios
                            .post("/login", { email, password })
                            .then((res) => {
                                Swal.fire({
                                    icon: "success",
                                    title: "Logged In!",
                                    text: "You are now logged in. Please refresh the page to proceed.",
                                    confirmButtonText: "OK",
                                }).then(() => {
                                    location.reload(); // Reload to update auth state
                                });
                            })
                            .catch(() => {
                                Swal.fire({
                                    icon: "error",
                                    title: "Login Failed",
                                    text: "Invalid email or password.",
                                    confirmButtonText: "OK",
                                });
                            });
                    });
                }
            }, 100);
        },
    },
};
</script>


<template>
    <title>Details</title>

    <section class="product-details py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 d-flex align-items-center text-center justify-content-center">
                    <div class="product-img">
                        <img :src="getProductImageUrl(product.file)" class="w-full img-fluid d-block" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-detals p-2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/" class="text-capitalize">home</a></li>
                                <li class="breadcrumb-item"><a href="#" class="text-capitalize">{{ product.category.name }}</a></li>
                            </ol>
                        </nav>

                        <h2 class="fw-bold mb-4">{{ product.name }}</h2>
                        <p class="fs-3 text-prmry mb-4">$99 - $199</p>

                        <!-- short description -->
                        <p class="mb-4 w-75" v-html="product.details"></p>



                        <!-- Devices Counter -->
                        <div class="d-flex flex-column gap-3 mb-3">
                            <h6 class="fw-bold">Device Access</h6>
                            <div class="d-flex align-items-center gap-2">
                                <button @click="updateDeviceAccess(-1)" class="btn btn-outline-info" :disabled="deviceAccess <= 1">-</button>
                                <input type="text" :value="deviceAccess" class="form-control text-center" style="width: 60px;" readonly />
                                <button @click="updateDeviceAccess(1)" class="btn btn-outline-info" :disabled="deviceAccess >= 2">+</button>
                            </div>
                        </div>

                        <!-- Duration Type Counter -->
                        <div class="d-flex flex-column gap-3">
                            <h6 class="fw-bold">Duration Type (Months)</h6>
                            <div class="d-flex align-items-center gap-2">
                                <button @click="updateDuration(-1)" class="btn btn-outline-info" :disabled="duration <= 1">-</button>
                                <input type="text" :value="duration" class="form-control text-center" style="width: 60px;" readonly />
                                <button @click="updateDuration(1)" class="btn btn-outline-info" :disabled="duration >= 12">+</button>
                            </div>
                        </div>

                        <hr>

                        <div class="pricing-part">
                            <div class="part-2">
                                <h4 class="product-price">${{ totalPrice }}</h4>
                            </div>
                        </div>

                        <div class="pricing-part">
                            <div class="part-2" v-if="product.discount_amount">
                                <h4 class="product-old-price text-decoration-line-through">
                                    ${{ product.amount }}
                                </h4>
                            </div>
                        </div>



                        <!-- buy now part -->
                        <div class="mt-4">
                            <a
                                v-if="auth"
                                href="#"
                                @click="addToCart($event, product)"
                                class="btn btn-success fw-bold btn-lg"
                            >
                                Buy Now
                            </a>
                            <a
                                v-else
                                href="#"
                                @click="promptLogin"
                                class="btn btn-warning fw-bold btn-lg"
                            >
                                Login to Buy
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion mt-5" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold shadow-none" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Description
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-4 w-75">
                                <h3 class="mb-4">How to Purchase a Package?</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae
                                    nostrum labore, illum ipsum, voluptate eius accusantium architecto nobis consequatur
                                    eligendi voluptates, illo totam tempore nesciunt.</p>
                            </div>
                            <div class="mb-4 w-75">
                                <h3 class="mb-4">How to Get an Account?</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae
                                    nostrum labore, illum ipsum, voluptate eius accusantium architecto nobis consequatur
                                    eligendi voluptates, illo totam tempore nesciunt.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item ">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold shadow-none" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Additional Information
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>Account Type</td>
                                    <td>Shared, Personal</td>
                                </tr>
                                <tr>
                                    <td>Duration</td>
                                    <td>1 Month, 3 Month, Half Yearly, Yearly</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-item ">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold shadow-none" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree">
                            Tutorial
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="w-full text-center">
                                <iframe width="560" class="player" src="https://www.youtube.com/embed/p_eq98EINOI?si=pUpTrD9pdR9lXzfg&amp;start=62" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- related products -->
    <section class="section-products py-5">
        <div class="container">
            <div class="section-title text-start mb-1">
                <h2 class="text-start h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Related Products</h2>
            </div>
            <div class="row mt-5">
                <!-- Single Product -->
                <div  v-for="(product, index) in allProduct" :key="index" class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-1" class="single-product">
                        <div class="part-1">
                            <span class="discount">15% off</span>
                            <Link class="d-inline-block" :href="`/product-details/${product.id}`">
                               <img :src="getProductImageUrl(product.file)" alt="Product Image">
                            </Link>
                        </div>
                        <div class="part-2" v-if="product.discount_amount">
                            <h3 class="product-title">{{ product.name }}</h3>
                            <h4 class="product-old-price text-decoration-line-through">
                                ${{ product.amount }}
                            </h4>
                            <h4 class="product-price">${{ product.discount_amount }}</h4>
                        </div>

                        <div class="part-2" v-else>
                            <h3 class="product-title">{{ product.name }}</h3>
                            <h4 class="product-price">${{ product.amount }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<style>
   .player {
       aspect-ratio: 16 / 9;

       @media screen and (max-width: 767.98px) {
           max-width: 400px;
       }

       @media screen and (max-width: 575.98px) {
           max-width: 300px;
       }

       @media screen and (max-width: 375.98px) {
           max-width: 250px;
       }
   }

   .product-img img {
       @media (min-width: 991.98px) {
           height: 550px;
       }
   }
</style>
