<script>
import Layout from "../frontend/Layout.vue";
import Swal from "sweetalert2";

export default {
    name: "ProductDetails",
    layout: Layout,
    props: {
        product: Object,
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
                            icon: 'warning',
                            title: 'Please Login',
                            html: `
                        <div>
                            <form id="login-form">
                                <div class="mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" id="password" placeholder="Password">
                                </div>
                                <button type="button" class="btn btn-primary w-100" id="login-button">Login</button>
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
        </div>
    </section>
</template>
