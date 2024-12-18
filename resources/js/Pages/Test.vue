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

        // Add to cart functionality
        addToCart(event, product, cartType) {
            event.preventDefault(); // Prevent link navigation or page reload

            // Prepare the data to send
            const data = {
                product_id: product.id,
                name: product.name,
                price: cartType === "buy" ? product.discount_amount || product.amount : 0.0,
                cart_type: cartType,
            };

            // Send the request to the backend
            axios.post('/cart/add', data)
                .then((response) => {
                    // Show success SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.data.message || 'Product added to cart successfully!',
                        confirmButtonText: 'OK',
                    });
                })
                .catch((error) => {
                    if (error.response && error.response.status === 409) {
                        // Handle duplicate product in the cart
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning!',
                            text: 'This product is already in your cart.',
                            confirmButtonText: 'OK',
                        });
                    } else if (error.response && error.response.status === 401) {
                        // Handle unauthenticated user
                        Swal.fire({
                            icon: 'warning',
                            title: 'Please Login',
                            text: 'You need to log in to add products to your cart.',
                            confirmButtonText: 'OK',
                        });
                        window.location.href = '/login'; // Redirect to login page
                    } else {
                        console.error("Error adding product to cart:", error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An unexpected error occurred.',
                            confirmButtonText: 'OK',
                        });
                    }
                });
        },
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
                                <button id="device-decrease" class="btn btn-outline-info">-</button>
                                <input id="device-counter" type="text" value="1" class="form-control text-center"
                                       style="width: 60px;" readonly />
                                <button id="device-increase" class="btn btn-outline-info">+</button>
                            </div>
                        </div>


                        <!-- Duration Type Counter -->
                        <div class="d-flex flex-column gap-3">
                            <h6 class="fw-bold">Duration Type (Months)</h6>
                            <div class="d-flex align-items-center gap-2">
                                <button id="decrease-btn" class="btn btn-outline-info">-</button>
                                <input id="duration-counter" type="text" value="1" class="form-control text-center"
                                       style="width: 60px;" readonly />
                                <button id="increase-btn" class="btn btn-outline-info">+</button>
                            </div>
                        </div>



                        <hr>
                        <div class="pricing-part">
                            <h4 class="text-danger"><strike>$199</strike> <span class="ms-2 fw-bold">$99</span></h4>
                        </div>



                        <!-- buy now part and free trial -->
                        <div class="buy-now-part mt-4">
                            <a href=""  @click="addToCart($event, product, 'buy')" class="btn btn-success fw-bold text-capitalize btn-lg">Buy Now <i
                                class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- accordion part -->
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
                            <div class="d-flex gap-3">
                                <a href="#">Buy <i class="fas fa-shopping-cart"></i></a>
                                <a href="#">Free<i class="fa-solid fa-gift"></i></a>
                            </div>
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
<style scoped>
.product-details .btn.active {
    background-color: #0dcaf0;
    /* Same as Bootstrap info background */
    color: white;
    border-color: #0dcaf0;
}
.product-details .buy-now-part{
    display: flex;
    gap: 16px;
}
</style>
