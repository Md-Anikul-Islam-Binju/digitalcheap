<script>
import Layout from "../frontend/Layout.vue";
export default {
    name: "ProductDetails",
    layout: Layout
}
</script>
<template>
    <section class="product-details py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 d-flex align-items-center text-center justify-content-center">
                    <div class="product-img">
                        <img src="frontend/images/Netflix-product.webp" class="w-full img-fluid d-block" alt="">
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
                        <h2 class="fw-bold mb-4">Artificial Intelligence</h2>
                        <p class="fs-3 text-prmry mb-4">$99 - $199</p>

                        <!-- short description -->

                        <p class="mb-4 w-75">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae
                            nostrum labore, illum ipsum, voluptate eius accusantium architecto nobis consequatur
                            eligendi voluptates, illo totam tempore nesciunt.</p>

                        <!-- Account Type -->
                        <div class="d-flex flex-column gap-3 mb-3">
                            <h6 class="fw-bold">Account Type</h6>
                            <div class="d-flex gap-1 gap-lg-2">
                                <button class="btn btn-outline-info account-type"
                                        data-group="account">Shared</button>
                                <button class="btn btn-outline-info account-type"
                                        data-group="account">Personal</button>
                            </div>
                        </div>

                        <!-- Duration Type -->
                        <div class="d-flex flex-column gap-3">
                            <h6 class="fw-bold">Duration Type</h6>
                            <div class="d-flex gap-1 gap-lg-2">
                                <button class="btn btn-outline-info duration-type" data-group="duration">1
                                    Month</button>
                                <button class="btn btn-outline-info duration-type" data-group="duration">3
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

                        <div class="my-3">
                            <label for="exampleFormControlInput1" class="form-label fw-bold">Input Email </label>
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                   placeholder="name@example.com">
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
