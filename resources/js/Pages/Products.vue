<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "Products",
    layout: Layout,
    props: {
        categories: Array,
        products: Array,
        authUser: Object,
    },
    data() {
        return {
            selectedCategory: null,  // Store the selected category
        };
    },
    computed: {
        // Filter products based on selected category
        filteredProducts() {
            if (this.selectedCategory === null) {
                return this.products;
            } else {
                return this.products.filter(product => product.category_id === this.selectedCategory);
            }
        }
    },
    methods: {
        // Set selected category for filtering
        filterByCategory(categoryId) {
            this.selectedCategory = categoryId;
        },
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
    <title>Product</title>
    <section class="cover-board-header">
        <img src="frontend/images/ai.jpg" class="h-100 w-100" alt="">
        <h1 class="text-center fw-bold text-uppercase display-5 position-absolute top-50 start-50 translate-middle">Product Hub</h1>
    </section>
    <section class="store-section my-5">
        <div class="container">
            <div class="section-title text-center mb-3 mb-md-5">
                <h2 class="text-start h3 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Our Products</h2>
            </div>
            <div class="store-part d-flex gap-5 w-100">
                <aside class="filter-part w-25 d-none d-md-block">
                    <div class="section-title text-start mb-1">
                        <h2 class="text-start h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Categories</h2>
                    </div>
                    <ul class="category-list list-unstyled">
                        <li
                            v-for="category in categories"
                            :key="category.id"
                            class="category-item my-2"
                            :class="{ 'active': selectedCategory === category.id }"
                            @click="filterByCategory(category.id)">
                            {{ category.name }}
                        </li>
                    </ul>
                </aside>
                <div class="product-show w-100">
                    <button class="btn btn-outline-success d-block d-md-none mb-2" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                            aria-controls="offcanvasExample">
                        Filter <i class="fa-solid fa-filter"></i>
                    </button>

                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                         aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="category-list list-unstyled">
                                <li
                                    v-for="category in categories"
                                    :key="category.id"
                                    class="category-item my-2"
                                    :class="{ 'active': selectedCategory === category.id }"
                                    @click="filterByCategory(category.id)">
                                    {{ category.name }}
                                </li>
                            </ul>


                        </div>
                    </div>
                    <div class="row g-2">
                        <div v-for="product in filteredProducts" :key="product.id" class="col-md-6 col-lg-4">
                            <div class="single-product">
                                <div class="part-1">
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
            </div>
        </div>
    </section>

    <!-- ========== Combo Offers ========== -->
    <section class="pricing">
        <div class="container">
            <div class="section-title text-center mb-3">
                <p class="fs-1 fw-medium text-center text-capitalize">Choose a plan that’s right for you</p>
            </div>
            <div class="d-flex justify-content-center align-items-center gap-3 switch-content">
                <div class="form-check form-check-inline ">
                    <input class="form-check-input" type="radio" name="pricing-period" value="monthly" id="flexRadioDefault1"
                           checked>
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
                            <h2 id="professional-price">$50</h2>
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
                            <h2 id="professional-price">$50</h2>
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
                            <h2 id="enterprise-price">$100</h2>
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
                            <h2 id="enterprise-price">$100</h2>
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
            </div>

        </div>
    </section>
</template>

<style scoped>
.filter-part {
    position: sticky;
    top: 0;
    padding: 15px;
}

.category-list .category-item {
    cursor: pointer;
    transition: var(--transition);
}

.category-list .category-item:hover {
    color: var(--logo-color);
}

.category-list .category-item.active {
    color: var(--logo-color);
}

.product-show .single-product {
    margin-bottom: 26px;
    background: #fff;
    border: #009244 2px solid;
    padding: 10px;
    border-radius: 10px;
    transition: all 0.3s ease-in-out;
    box-shadow: 0px 30px 12px rgba(0, 0, 0, 0.1);
}

.product-show .single-product .part-1 {
    position: relative;
    height: 250px;
    max-height: 250px;
    margin-bottom: 20px;
    overflow: hidden;
}

.product-show .single-product .part-1 img {
    max-height: 250px;
    height: 250px;
    width: 100%;
    object-fit: cover;
    transition: all 0.3s;
    border-radius: 10px 10px 0 0;
}

.product-show .single-product .part-1 .discount,
.product-show .single-product .part-1 .new {
    position: absolute;
    top: 15px;
    left: 20px;
    color: #ffffff;
    background-color: #fe302f;
    padding: 2px 8px;
    text-transform: uppercase;
    font-size: 0.85rem;
    border-radius: 2px;
}

.product-show .single-product .part-1 .new {
    left: 0;
    background-color: var(--logo-color);
}

.product-show .single-product:hover .part-1 img {
    transform: scale(1.2, 1.2) rotate(5deg);
}

.product-show .single-product .part-1 div {
    position: absolute;
    bottom: -41px;
    left: 20px;
    margin: 0;
    padding: 0;
    list-style: none;
    opacity: 0;
    transition: bottom 0.5s, opacity 0.5s;
}

.product-show .single-product:hover .part-1 div {
    bottom: 30px;
    opacity: 1;
}

.product-show .single-product .part-1 div a {
    display: inline-flex;
    gap: 10px;
    justify-content: center;
    align-items: center;
    border-radius: 30px;
    padding: 8px 15px;
    font-size: 14px;
    line-height: 24px;
    background-color: var(--logo-color);
    color: white;
    text-align: center;
    box-shadow: 0 2px 20px rgb(50 50 50 / 10%);
    transition: var(--transition);
}


.product-show .single-product .part-1 div a:hover {
    color: black;
    background: var(--prmry-color);
}

.product-show .single-product .part-2 .product-title {
    font-size: 1rem;
    margin-bottom: 10px;
}

.product-show .single-product .part-2 .product-old-price {
    position: relative;
    padding: 0 7px;
    margin-right: 2px;
    opacity: 0.6;
}

.product-show .single-product .part-2 h4 {
    display: inline-block;
    font-size: 1rem;
}
</style>
