<script>
import Layout from "../frontend/Layout.vue";
import Swal from "sweetalert2";

export default {
    name: "ProductDetails",
    layout: Layout,
    props: {
        product: Object,
        allProduct: Array,
    },
    data() {
        return {
            duration: 1, // Default duration (months)
            deviceAccess: 1, // Default device access
        };
    },
    computed: {
        baseUrl() {
            return window.location.origin;
        },
    },
    methods: {
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

            const data = {
                product_id: product.id,
                name: product.name,
                price: product.discount_amount || product.amount, // Use discount price if available
                duration: this.duration,
                device_access: this.deviceAccess,
            };

            axios.post('/cart/add', data)
                .then((response) => {
                    if (response.data.authenticated) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.data.message || 'Product added to cart successfully!',
                            confirmButtonText: 'OK',
                        });
                    }
                })
                .catch((error) => {
                    if (error.response && error.response.status === 401) {
                        // Show login modal
                        Swal.fire({
                            title: 'Sign up for free',
                            html: `
                        <div>
                            <form id="login-form">
                                    <div class="form-floating mb-3">
                                      <input type="email" class="form-control" id="email" placeholder="name@example.com">

                                    </div>
                                    <div class="form-floating mb-3">
                                      <input type="password" class="form-control" id="password" placeholder="Password">
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
                                    <h2 class="fs-5 fw-bold mb-3">You Have No Account</h2>
                                    <a href="/account-registration-for-user" class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" target="_blank">
                                      Sign Up
                                    </a>
                                  </form>
                        </div>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });

                        // Attach login event to the button inside the modal
                        setTimeout(() => {
                            const loginButton = document.getElementById('login-button');
                            if (loginButton) {
                                loginButton.addEventListener('click', () => {
                                    const email = document.getElementById('email').value;
                                    const password = document.getElementById('password').value;

                                    axios.post('/login', { email, password })
                                        .then((res) => {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Logged In!',
                                                text: 'You are now logged in. Please try adding the product again.',
                                                confirmButtonText: 'OK',
                                            });
                                        })
                                        .catch((err) => {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Login Failed',
                                                text: 'Invalid email or password.',
                                                confirmButtonText: 'OK',
                                            });
                                        });
                                });
                            }
                        }, 100);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An unexpected error occurred.',
                            confirmButtonText: 'OK',
                        });
                    }
                });
        }

    },
};
</script>

<template>
    <title>Details</title>
    <section class="cover-board-header">
        <img :src="`${baseUrl}/frontend/images/ai.jpg`" class="h-100 w-100" alt="">
        <h1 class="text-center fw-bold text-uppercase display-5 position-absolute top-50 start-50 translate-middle">
            Product Details
        </h1>
    </section>
    <section class="product-details py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 d-flex align-items-center text-center justify-content-center">
                    <div class="product-img">
                        <img :src="getProductImageUrl(product.file)" class="w-full img-fluid d-block" alt="" style="height: 550px;">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-detals p-2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/" class="text-capitalize">home</a></li>
                                <li class="breadcrumb-item"><a href="#" class="text-capitalize">Education</a></li>
                            </ol>
                        </nav>

                        <h2 class="fw-bold mb-4">{{ product.name }}</h2>
                        <p class="fs-3 text-prmry mb-4">$99 - $199</p>

                        <!-- short description -->
                        <p class="mb-4 w-75">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae
                            nostrum labore, illum ipsum, voluptate eius accusantium architecto nobis consequatur
                            eligendi voluptates, illo totam tempore nesciunt.</p>

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
                            <h4 class="text-danger"><strike>$199</strike> <span class="ms-2 fw-bold">$99</span></h4>
                        </div>

                        <!-- buy now part -->
                        <div class="buy-now-part mt-4">
                            <a href="#" @click="addToCart($event, product)" class="btn btn-success fw-bold text-capitalize btn-lg">Buy Now
                                <i class="fas fa-shopping-cart"></i>
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
                                <h3 class="mb-4">Our Services</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae
                                    nostrum labore, illum ipsum, voluptate eius accusantium architecto nobis consequatur
                                    eligendi voluptates, illo totam tempore nesciunt.</p>
                            </div>
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
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/lJzVc2uN5tc?si=naK4zpACgvA8DTCg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
                            <img :src="getProductImageUrl(product.file)" alt="Product Image">
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
