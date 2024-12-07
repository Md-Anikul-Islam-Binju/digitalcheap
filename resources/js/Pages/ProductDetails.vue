<script>
import Layout from "../frontend/Layout.vue";
export default {
    name: "ProductDetails",
    layout: Layout,
    props:{
        product:Object,
        allProduct:Array
    },
    methods:{
        getProductImageUrl(productImagePath) {
            if (!productImagePath) {
                return 'frontend/images/file.jpg'; // Fallback image
            }
            return `${window.location.origin}/images/product/${productImagePath}`;
        },
    }
}
</script>
<template>
    <title>Details</title>
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


                        <!-- Duration Type -->
                        <div class="d-flex flex-column gap-3">
                            <h6 class="fw-bold">Duration Type</h6>
                            <div class="d-flex gap-1 gap-lg-2">
                                <button class="btn btn-outline-info duration-type" data-group="duration">1
                                    Month</button>
                                <button class="btn btn-outline-info duration-type" data-group="duration">Half
                                    Yearly</button>
                                <button class="btn btn-outline-info duration-type"
                                        data-group="duration">Yearly</button>
                            </div>
                        </div>

                        <div class="clear-btn mt-2 text-secondary d-inline-block" role="button">
                            CLEAR
                        </div>
                        <hr>
                        <div class="pricing-part">
                            <h4 class="text-danger"><strike>$199</strike> <span class="ms-2 fw-bold">$99</span></h4>
                        </div>



                        <!-- buy now part and free trial -->
                        <div class="buy-now-part mt-4">
                            <button class="btn btn-success fw-bold text-capitalize btn-lg">Buy Now <i
                                class="fas fa-shopping-cart"></i>
                            </button>
                            <button class="btn btn-outline-success fw-bold text-capitalize btn-lg">
                                Free Trial <i class="fa-solid fa-gift"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- accordion part -->
            <div class="accordion mt-5" id="accordionExample">
                <div class="accordion-item ">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold shadow-none" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Description
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="mb-4 w-75">
                            <h3 class="mb-4">Our Services</h3>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae
                            nostrum labore, illum ipsum, voluptate eius accusantium architecto nobis consequatur
                            eligendi voluptates, illo totam tempore nesciunt.</p>
                            <p class="mb-4 w-75">
                            <h3 class="mb-4">How to Purchase a Package?</h3>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae
                            nostrum labore, illum ipsum, voluptate eius accusantium architecto nobis consequatur
                            eligendi voluptates, illo totam tempore nesciunt.</p>
                            <p class="mb-4 w-75">
                            <h3 class="mb-4">How to Get an Account?</h3>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae
                            nostrum labore, illum ipsum, voluptate eius accusantium architecto nobis consequatur
                            eligendi voluptates, illo totam tempore nesciunt.</p>
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
