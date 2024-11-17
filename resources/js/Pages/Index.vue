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
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true" data-bs-interval="5000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="frontend/images/file.jpg" class="d-block w-100 object-fit-cover" alt="...">
                    <!-- for overlay if needed then go to style.css and comment out -->
                    <div class="overlay"></div>
                </div>
                <div class="carousel-item">
                    <img src="frontend/images/ott.jpg" class="d-block w-100 object-fit-cover" alt="...">
                    <div class="overlay"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- core values section -->
    <section class="core-values py-5">
        <div class="container">
            <div class="section-title text-center mb-1">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Core Values</h2>
            </div>
            <div class="row align-items-center mt-md-5 justify-content-center gap-2 gap-md-0 justify-content-md-between">
                <div class="col-5 col-md-2 text-center p-3 shadow-sm rounded value-card">
                    <div class="mb-1 fs-1">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h4 class="">Live Chat</h4>
                </div>
                <div class="col-5 col-md-2 text-center p-3 shadow-sm rounded value-card">
                    <div class="mb-1 fs-1">
                        <i class="fa-regular fa-credit-card"></i>
                    </div>
                    <h4 class="">Secure Payment</h4>
                </div>
                <div class="col-5 col-md-2 text-center p-3 shadow-sm rounded value-card">
                    <div class="mb-1 fs-1">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <h4 class="">24/7 Support</h4>
                </div>
                <div class="col-5 col-md-2 text-center p-3 shadow-sm rounded value-card">
                    <div class="mb-1 fs-1">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h4 class="">Affiliate Program</h4>
                </div>
                <div class="col-5 col-md-2 text-center p-3 shadow-sm rounded value-card">
                    <div class="mb-1 fs-1">
                        <i class="fa-solid fa-truck"></i>
                    </div>
                    <h4 class="">Instant Delivery</h4>
                </div>
                <div class="col-5 col-md-2 text-center p-3 shadow-sm rounded value-card">
                    <div class="mb-1 fs-1">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <h4 class="">Daily Update</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Section -->
    <section class="why-section py-5">
        <div class="container">
            <div class="section-title text-center mb-1">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Why Shoroborno?</h2>
                <p class="fs-1 fw-medium text-center text-capitalize">Understanding the Decision</p>
            </div>
            <div class="row align-items-center mt-md-5">
                <div class="col-12 col-md-6 text-center p-3">
                    <img src="frontend/images/why.jpg" class="mx-auto img-fluid object-fit-cover rounded" alt="">
                </div>
                <div class="col-12 col-md-6 mt-5 mt-md-0 ps-lg-5">
                    <h3 class="fw-bold text-success text-center text-md-start mb-4">Your Satisfaction, Our Priority</h3>

                    <p class="mb-4">Available 24/7/365, we believe that exceptional service is essential. Our team is committed to making your experience smooth and enjoyable. We listen, respond promptly, and offer personalized support to meet your needs. Whether guiding you through options or addressing concerns, we’re here every step of the way. Your satisfaction drives us, and we aim to exceed expectations. With us, you're not just a customer; you’re a valued part of our community.</p>

                    <a href="#" class="btn btn-success">Learn More</a>
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
                        <div class="featured-box-icon text-prmry display-5"><i class="fas fa-bullhorn"></i></div>
                        <h4 class="fw-600 mb-3">SEO Marketing</h4>
                        <p class="text-muted mb-0" style="line-height: 1.8;">Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="featured-box px-md-4 text-center mb-4">
                        <div class="featured-box-icon text-prmry display-5"><i class="fa-solid fa-user-astronaut"></i></div>
                        <h4 class="fw-600 mb-3">AI Subscription</h4>
                        <p class="text-muted mb-0" style="line-height: 1.8;">Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="featured-box px-md-4 text-center mb-4">
                        <div class="featured-box-icon text-prmry display-5"><i class="fa-brands fa-steam"></i></div>
                        <h4 class="fw-600 mb-3">OTT Subscription</h4>
                        <p class="text-muted mb-0" style="line-height: 1.8;">Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="featured-box px-md-4 text-center mb-4">
                        <div class="featured-box-icon text-prmry display-5"><i class="fa-solid fa-basketball"></i></div>
                        <h4 class="fw-600 mb-3">Sports Subscription</h4>
                        <p class="text-muted mb-0" style="line-height: 1.8;">Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry. </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- our partner section -->
    <section class="our-partner py-5 d-flex justify-content-center">
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

    <!-- Usabilty -->
    <section class="usabilty-section py-5">
        <div class="container">
            <div class="section-title text-center mb-1">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Useablity</h2>
                <p class="fs-1 fw-medium text-center text-capitalize">Designed for Your Ease</p>
            </div>
            <div class="row align-items-center mt-2">
                <div class="col-12 col-md-6 text-center p-3 mt-3 mt-md-0">
                    <div class="use-card p-4 shadow-lg  rounded">
                        <a class="my-video-links" data-autoplay="true" data-vbtype="video" href="https://youtu.be/yVYQeDhAQWk?si=WAFl70-J1PIF4AVa"><i class="fa-solid fa-circle-play"></i></a>
                        <h3 class="fw-bold text-center mb-4">How to Use</h3>
                        <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt natus illum omnis quam aut beatae quaerat fuga doloribus enim est.</p>
                        <a href="#" class="text-prmry more-btn">Learn More <i class="fas fa-arrow-right ri"></i></a>
                    </div>
                </div>
                <div class="col-12 col-md-6 text-center mt-2 mt-md-0 p-3">
                    <div class="use-card p-4 shadow-lg  rounded">
                        <a class="my-video-links" data-autoplay="true" data-vbtype="video" href="https://youtu.be/Ar7nVbjAsEw?si=N3v93yn4Zxd1Z0DO"><i class="fa-solid fa-circle-play"></i></a>
                        <h3 class="fw-bold text-center mb-4">How to Access</h3>
                        <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt natus illum omnis quam aut beatae quaerat fuga doloribus enim est.</p>
                        <a href="#" class="text-prmry more-btn">Learn More <i class="fas fa-arrow-right ri"></i></a>
                    </div>
                </div>
            </div>
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
                            <span class="discount">15% off</span>
                            <img src="frontend/images/Netflix-product.webp" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">Netflix Subscription</h3>
                            <h4 class="product-old-price text-decoration-line-through">$79.99</h4>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-2" class="single-product">
                        <div class="part-1">
                            <span class="new">new</span>
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
                            <span class="discount">10% off</span>
                            <img src="frontend/images/Netflix-product.webp" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">Netflix Subscription</h3>
                            <h4 class="product-old-price text-decoration-line-through">$79.99</h4>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-4" class="single-product">
                        <div class="part-1">
                            <span class="discount">15% off</span>
                            <img src="frontend/images/AiProduct.jpg" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">AI Subscription</h3>
                            <h4 class="product-old-price text-decoration-line-through">$79.99</h4>
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
                            <span class="discount">15% off</span>
                            <img src="frontend/images/Netflix-product.webp" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">Netflix Subscription</h3>
                            <h4 class="product-old-price text-decoration-line-through">$79.99</h4>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-3" class="single-product">
                        <div class="part-1">
                            <span class="discount">15% off</span>
                            <img src="frontend/images/Netflix-product.webp" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">Netflix Subscription</h3>
                            <h4 class="product-old-price text-decoration-line-through">$79.99</h4>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-3" class="single-product">
                        <div class="part-1">
                            <span class="discount">15% off</span>
                            <img src="frontend/images/Netflix-product.webp" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">Netflix Subscription</h3>
                            <h4 class="product-old-price text-decoration-line-through">$79.99</h4>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-3" class="single-product">
                        <div class="part-1">
                            <span class="discount">15% off</span>
                            <img src="frontend/images/Netflix-product.webp" class="" alt="">
                            <div>
                                <a href="#">Buy Now <i class="fas fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">Netflix Subscription</h3>
                            <h4 class="product-old-price text-decoration-line-through">$79.99</h4>
                            <h4 class="product-price">$49.99</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-3" class="single-product">
                        <div class="part-1">
                            <span class="new">new</span>
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
                    <input class="form-check-input" type="radio" name="pricing-period" value="monthly" id="flexRadioDefault1" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Monthly
                    </label>
                </div>
                <div class="form-check form-check-inline ">
                    <input class="form-check-input" type="radio" name="pricing-period" value="halfYearly" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Half Yearly
                    </label>
                </div>
                <div class="form-check form-check-inline ">
                    <input class="form-check-input" type="radio" name="pricing-period" value="yearly" id="flexRadioDefault3">
                    <label class="form-check-label" for="flexRadioDefault3">
                        Yearly
                    </label>
                </div>

            </div>

            <!-- ================== pricing plans ================ -->

            <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-combo-tab" data-bs-toggle="pill" data-bs-target="#pills-combo" type="button" role="tab" aria-controls="pills-combo" aria-selected="true">Combo Offers</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-seo-tab" data-bs-toggle="pill" data-bs-target="#pills-seo" type="button" role="tab" aria-controls="pills-seo" aria-selected="false">SEO</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-sports-tab" data-bs-toggle="pill" data-bs-target="#pills-sports" type="button" role="tab" aria-controls="pills-sports" aria-selected="false">Sports</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-ai-tab" data-bs-toggle="pill" data-bs-target="#pills-ai" type="button" role="tab" aria-controls="pills-ai" aria-selected="false">AI</button>
                </li>
            </ul>

            <div class="row mt-4 mixitup-container">
                <!-- Freebie Plan -->
                <div class="col-md-6 col-lg-4 mb-4 mix">
                    <div class="pricingCard">
                        <div class="pricingCard-header text-left">
                            <h4 class="pricingCard-title">Freebie</h4>
                            <p class="pricingCard-text">
                                Ideal for individuals who need quick access to basic
                                features.
                            </p>
                        </div>
                        <div class="pricingCard-body text-left">
                            <h2 id="free-price">$0</h2>
                            <p class="pricing-period">/ Month</p>
                        </div>
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
                        <div class="pricingCard-footer">
                            <a href="#">Get Free Trial Now</a>
                            <a href="#">Get Started Now</a>
                        </div>
                    </div>
                </div>

                <!-- Professional Plan -->
                <div class="col-md-6 col-lg-4 mb-4 mix">
                    <div class="pricingCard">
                        <div class="pricingCard-header text-left">
                            <h4 class="pricingCard-title">Professional</h4>
                            <p class="pricingCard-text">
                                Ideal for individuals who need advanced features and tools
                                for client work.
                            </p>
                        </div>
                        <div class="pricingCard-body text-center">
                            <h2 id="professional-price" >$50</h2>
                            <p class="pricing-period">/ Month</p>
                        </div>
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
                        <div class="pricingCard-footer">
                            <a href="#">Get Free Trial Now</a>
                            <a href="#">Get Started Now</a>
                        </div>
                    </div>
                </div>
                <!-- Professional Plan -->
                <div class="col-md-6 col-lg-4 mb-4 mix">
                    <div class="pricingCard">
                        <div class="pricingCard-header text-left">
                            <h4 class="pricingCard-title">Professional</h4>
                            <p class="pricingCard-text">
                                Ideal for individuals who need advanced features and tools
                                for client work.
                            </p>
                        </div>
                        <div class="pricingCard-body text-center">
                            <h2 id="professional-price" >$50</h2>
                            <p class="pricing-period">/ Month</p>
                        </div>
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
                        <div class="pricingCard-footer">
                            <a href="#">Get Free Trial Now</a>
                            <a href="#">Get Started Now</a>
                        </div>
                    </div>
                </div>

                <!-- Enterprise Plan -->
                <div class="col-md-6 col-lg-4 mb-4 mix">
                    <div class="pricingCard">
                        <div class="pricingCard-header text-left">
                            <h4 class="pricingCard-title">Enterprise</h4>
                            <p class="pricingCard-text">
                                Ideal for businesses who need personalized services and
                                security for large teams.
                            </p>
                        </div>
                        <div class="pricingCard-body text-center">
                            <h2 id="enterprise-price" >$100</h2>
                            <p class="pricing-period">/ Month</p>
                        </div>
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
                        <div class="pricingCard-footer">
                            <a href="#">Get Free Trial Now</a>
                            <a href="#">Get Started Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4 mix">
                    <div class="pricingCard">
                        <div class="pricingCard-header text-left">
                            <h4 class="pricingCard-title">Enterprise</h4>
                            <p class="pricingCard-text">
                                Ideal for businesses who need personalized services and
                                security for large teams.
                            </p>
                        </div>
                        <div class="pricingCard-body text-center">
                            <h2 id="enterprise-price" >$100</h2>
                            <p class="pricing-period">/ Month</p>
                        </div>
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
                        <div class="pricingCard-footer">
                            <a href="#" >Get Free Trial Now</a>
                            <a href="#">Get Started Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- More/Hide Button -->
            <div class="text-center mt-4">
                <button class="btn btn-success" id="toggle-btn">More</button>
            </div>
        </div>
    </section>

    <!-- customer review -->
    <section class="customer-review py-5">
        <div class="container">
            <div class="row">
                <div class="section-title text-center mb-3">
                    <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Client's Review</h2>
                    <p class="fs-1 fw-medium text-center text-capitalize">Voices of Satisfaction</p>
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
