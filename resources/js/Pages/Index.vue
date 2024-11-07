<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "Index",
    layout: Layout
}
</script>

<template>
    <!-- hero section -->
    <section class="hero-section">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="frontend/images/seo.jpg" class="d-block w-100 object-fit-cover" alt="...">
                    <div class="overlay"></div>
                </div>
                <div class="carousel-item">
                    <img src="frontend/images/ott.jpg" class="d-block w-100 object-fit-cover" alt="...">
                    <div class="overlay"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Section -->
    <section class="why-section py-5">
        <div class="container">
            <div class="why-title">
                <div class="section-title text-center mb-1">
                    <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1 ">Why Shoroborno?</h2>
                    <p class="fs-1 fw-medium text-center">Understanding the Decision</p>
                </div>
            </div>
            <div class="row align-items-center mt-5">
                <div class="col-12 col-md-6 order-1 order-md-0 mt-5 mt-md-0">
                    <h2 class="fw-bold text-success text-center text-md-start">We Provide The Best... </h2>
                    <ul class="mt-5">
                        <li class="fs-5 my-1"><img src="frontend/images/Correct.svg" alt="" class=" me-2"> Secure Service</li>
                        <li class="fs-5 my-1"><img src="frontend/images/Correct.svg" alt="" class=" me-2"> 24/7 Support</li>
                        <li class="fs-5 my-1"><img src="frontend/images/Correct.svg" alt="" class=" me-2"> daily Update</li>
                        <li class="fs-5 my-1"><img src="frontend/images/Correct.svg" alt="" class=" me-2"> Easy To Use</li>
                        <li class="fs-5 my-1"><img src="frontend/images/Correct.svg" alt="" class=" me-2"> Easy To Use</li>
                        <li class="fs-5 my-1"><img src="frontend/images/Correct.svg" alt="" class=" me-2"> Easy To Use</li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 text-center text-md-start order-0">
                    <img src="frontend/images/why.png" class="w-75 img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- service section -->
    <section class="service-section py-5">
        <div class="container">
            <div class="section-title text-center mb-1">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Our Services</h2>
                <p class="fs-1 fw-medium text-center text-capitalize">How can we help you</p>
            </div>
            <div class="row mt-5">

                <div class="col-sm-6 col-lg-3">
                    <div class="featured-box px-md-4 text-center mb-4">
                        <div class="featured-box-icon text-prmry display-4"><i class="fas fa-bullhorn"></i></div>
                        <h4 class="fw-600 mb-3">SEO Marketing</h4>
                        <p class="text-muted mb-0" style="line-height: 1.8;">Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="featured-box px-md-4 text-center mb-4">
                        <div class="featured-box-icon text-prmry display-4"><i class="fa-solid fa-user-astronaut"></i></div>
                        <h4 class="fw-600 mb-3">AI Subscription</h4>
                        <p class="text-muted mb-0" style="line-height: 1.8;">Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="featured-box px-md-4 text-center mb-4">
                        <div class="featured-box-icon text-prmry display-4"><i class="fa-brands fa-steam"></i></div>
                        <h4 class="fw-600 mb-3">OTT Subscription</h4>
                        <p class="text-muted mb-0" style="line-height: 1.8;">Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="featured-box px-md-4 text-center mb-4">
                        <div class="featured-box-icon text-prmry display-4"><i class="fa-solid fa-basketball"></i></div>
                        <h4 class="fw-600 mb-3">Sports Subscription</h4>
                        <p class="text-muted mb-0" style="line-height: 1.8;">Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry. </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- our partner section -->
    <section class="our-partner py-5 d-flex justify-content-center
  ">
        <div class="container">
            <div class="section-title text-center mb-1">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Our Partner</h2>
                <p class="fs-1 fw-medium text-center text-capitalize">Collaborating for Growth</p>
            </div>
            <marquee behavior="scroll" direction="rtl">
                <img src="frontend/images/ssl.png" alt="">
                <img src="frontend/images/googlechrome.jpg" width="400px" alt="">
                <img src="frontend/images/mozila firefox.png" width="300px" alt="">
                <img src="frontend/images/digital.webp" width="500px" alt="">
                <img src="frontend/images/Microsoft-Edge-Chromium-banner.png" width="300px" alt="">
                <img src="frontend/images/ssl.png" alt="">
            </marquee>
        </div>
    </section>
    <!-- ===========Our product section========== -->
    <section class="section-products py-5">
        <div class="container">
            <div class="section-title text-center mb-1">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Our Product</h2>
                <p class="fs-1 fw-medium text-center text-capitalize">Quality You Can Rely On</p>
            </div>
            <div class="row mt-5">
                <!-- Single Product -->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-1" class="single-product">
                        <div class="part-1">
                            <img src="frontend/images/Netflix-product.webp" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">Netflix Subscription</h3>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-2" class="single-product">
                        <div class="part-1">
                            <img src="frontend/images/sports.jpg" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">Sports Subscription</h3>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-3" class="single-product">
                        <div class="part-1">
                            <img src="frontend/images/Netflix-product.webp" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">Netflix Subscription</h3>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-4" class="single-product">
                        <div class="part-1">
                            <img src="frontend/images/AiProduct.jpg" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">AI Subscription</h3>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============Best Seller Section============= -->
    <section class="best-seller py-5 section-products">
        <div class="container">
            <div class="section-title text-center mb-1">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Best Sellers</h2>

            </div>
            <div class="row mt-5 my-slider">
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-3" class="single-product">
                        <div class="part-1">
                            <img src="frontend/images/Netflix-product.webp" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">Netflix Subscription</h3>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-3" class="single-product">
                        <div class="part-1">
                            <img src="frontend/images/Netflix-product.webp" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">Netflix Subscription</h3>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-3" class="single-product">
                        <div class="part-1">
                            <img src="frontend/images/Netflix-product.webp" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">Netflix Subscription</h3>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-3" class="single-product">
                        <div class="part-1">
                            <img src="frontend/images/Netflix-product.webp" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">Netflix Subscription</h3>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-3" class="single-product">
                        <div class="part-1">
                            <img src="frontend/images/Netflix-product.webp" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">Netflix Subscription</h3>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== Combo Offers ========== -->
    <section class="pricing">
        <div class="container">
            <div class="section-title text-center mb-3">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Combo Offers</h2>
                <p class="fs-1 fw-medium text-center text-capitalize">Choose a plan that’s right for you</p>
            </div>
            <div class="d-flex justify-content-center align-items-center gap-3 switch-content">
                <div class="form-check form-check-inline ">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Monthly
                    </label>
                </div>
                <div class="form-check form-check-inline ">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Half Yearly
                    </label>
                </div>
                <div class="form-check form-check-inline ">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                    <label class="form-check-label" for="flexRadioDefault3">
                        Yearly
                    </label>
                </div>

            </div>
            <!-- ================== pricing plans ================ -->
            <div class="row mt-4">
                <!-- Freebie Plan -->
                <div class="col-md-4 mb-4">
                    <div class="pricingCard">
                        <div class="pricingCard-header text-left">
                            <h4 class="pricingCard-title">Freebie</h4>
                            <p class="pricingCard-text">
                                Ideal for individuals who need quick access to basic
                                features.
                            </p>
                        </div>
                        <div class="pricingCard-body text-left">
                            <h2>$0</h2>
                            <p>/ Month</p>
                        </div>
                        <a href="#">Get Started Now</a>
                        <ul>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Phishing Email
                                Perform
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Phishing Website
                                Perform
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Sender Profile
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Training Module
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Sender Module
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Cross.svg" alt=""><del>Email import to Verification</del>
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Cross.svg" alt=""><del>Instant Campaign</del>
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Cross.svg" alt=""><del>System Report Generate and Graph</del>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Professional Plan -->
                <div class="col-md-4 mb-4">
                    <div class="pricingCard">
                        <div class="pricingCard-header text-left">
                            <h4 class="pricingCard-title">Professional</h4>
                            <p class="pricingCard-text">
                                Ideal for individuals who need advanced features and tools
                                for client work.
                            </p>
                        </div>
                        <div class="pricingCard-body text-center">
                            <h2>$50</h2>
                            <p>/ Month</p>
                        </div>
                        <a href="#">Get Started Now</a>
                        <ul>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Phishing Email
                                Perform
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Phishing Website
                                Perform
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Sender Profile
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Training Module
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Domain Verification
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Employee List
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Cross.svg" alt=""><del>Instant Campaign</del>
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Cross.svg" alt="">
                                <del>System Report Generate and Graph</del>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Enterprise Plan -->
                <div class="col-md-4 mb-4">
                    <div class="pricingCard">
                        <div class="pricingCard-header text-left">
                            <h4 class="pricingCard-title">Enterprise</h4>
                            <p class="pricingCard-text">
                                Ideal for businesses who need personalized services and
                                security for large teams.
                            </p>
                        </div>
                        <div class="pricingCard-body text-center">
                            <h2>$100</h2>
                            <p>/ Month</p>
                        </div>
                        <a href="#">Get Started Now</a>
                        <ul>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Phishing Email
                                Perform
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Phishing Website
                                Perform
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Sender Profile
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Training Module
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Domain Verification
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Employee List
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">Campaign
                            </li>
                            <li class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="">System Report
                                Generate and Graph
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- customer review -->
    <section class="customer-review py-5">
        <div class="container">
            <div class="row">
                <div class="section-title text-center mb-3">
                    <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Combo Offers</h2>
                    <p class="fs-1 fw-medium text-center text-capitalize">Choose a plan that’s right for you</p>
                </div>
            </div>
            <div class="row mt-5 review-slider">
                <div class="col-lg-4 text-center  p-5">
                    <img src="frontend/images/shoot-me-now-linkedin-profile-picture.jpg" width="70px" class="mb-1 mx-auto" alt="">
                    <p class="h6 text-secondary my-3">Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
                    <h2 class="fw-normal text-prmry">Chegs</h2>
                    <p>CEO, Company, Inc.</p>
                </div>
                <div class="col-lg-4 text-center  p-5">
                    <img src="frontend/images/shoot-me-now-linkedin-profile-picture.jpg" width="70px" class="mb-1 mx-auto" alt="">
                    <p class="h6 text-secondary my-3">Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
                    <h2 class="fw-normal text-prmry">Trump</h2>
                    <p>CEO, Company, Inc.</p>
                </div>
                <div class="col-lg-4 text-center  p-5">
                    <img src="frontend/images/shoot-me-now-linkedin-profile-picture.jpg" width="70px" class="mb-1 mx-auto" alt="">
                    <p class="h6 text-secondary my-3">Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
                    <h2 class="fw-normal text-prmry">Harish</h2>
                    <p>CEO, Company, Inc.</p>
                </div>
                <div class="col-lg-4 text-center  p-5">
                    <img src="frontend/images/shoot-me-now-linkedin-profile-picture.jpg" width="70px" class="mb-1 mx-auto" alt="">
                    <p class="h6 text-secondary my-3">Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
                    <h2 class="fw-normal text-prmry">Biden</h2>
                    <p>CEO, Company, Inc.</p>
                </div>
            </div>
        </div>
    </section>

</template>

<style scoped>

</style>
