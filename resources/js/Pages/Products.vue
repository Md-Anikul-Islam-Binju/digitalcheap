<script>
import Layout from "../frontend/Layout.vue";
import Swal from "sweetalert2";

export default {
    name: "Products",
    layout: Layout,
    props: {
        categories: Array,
        products: Array,
        authUser: Object,
        packages: Array,
        auth: Boolean,
    },
    data() {
        return {
            selectedCategory: null,  // Store the selected category
            selectedType: "Monthly", // Default to "Monthly"
            packageTypes: [
                { value: "Monthly", label: "Monthly" },
                { value: "Half Yearly", label: "Half Yearly" },
                { value: "Yearly", label: "Yearly" },
            ],
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
        },

        filteredPackages() {
            return this.packages.filter((pkg) => {
                const matchesCategory =
                    !this.selectedCategory || pkg.category_id === this.selectedCategory;
                const matchesType = pkg.package_types.includes(this.selectedType);

                return matchesCategory && matchesType;
            });
        },
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

        handlePackageSelection(pkg, type) {
            if (!this.auth) {
                this.promptLogin(); // Prompt login if the user is not authenticated
                return;
            }
            this.addToCartPackage(pkg, type);
        },
        addToCartPackage(pkg, type) {
            const data = {
                package_id: pkg.id,
                package_duration: this.selectedType,
                package_price: pkg.pricing[this.selectedType],
                package_type: type,
            };

            axios.post('/cart/package/add', data)
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.data.message || 'Package added to cart successfully!',
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
            const scrollPosition = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
            document.body.style.position = 'fixed';
            document.body.style.top = `-${scrollPosition}px`;
            document.body.style.width = '100%';
            Swal.fire({
                title: "Login Required",
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
                willClose: () => {

                    document.body.style.position = '';
                    document.body.style.top = '';
                    document.body.style.width = '';


                    window.scrollTo(0, scrollPosition);
                }
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
                                    location.reload();
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
    }
}
</script>
<template>
    <title>Product</title>
<!--    <section class="cover-board-header">-->
<!--        <img src="frontend/images/ai.jpg" class="h-100 w-100" alt="">-->
<!--        <h1 class="text-center fw-bold text-uppercase display-5 position-absolute top-50 start-50 translate-middle">Product</h1>-->
<!--    </section>-->

    <section class="store-section my-5">
        <div class="container">
            <div class="section-title text-center mb-3 mb-md-5">
                <h2 class="text-start h3 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Individual pricing</h2>
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
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Combo Offers</h2>
                <p class="fs-1 fw-medium text-center text-capitalize">Choose a plan that’s right for you</p>
            </div>

            <!-- Package Type Filter -->
            <div class="d-flex justify-content-center align-items-center gap-3 switch-content">
                <div class="form-check form-check-inline" v-for="(type, index) in packageTypes" :key="index">
                    <input
                        class="form-check-input"
                        type="radio"
                        :value="type.value"
                        v-model="selectedType"
                        :id="'type-' + index"
                    />
                    <label class="form-check-label" :for="'type-' + index">{{ type.label }}</label>
                </div>
            </div>

            <!-- Displaying Packages -->
            <div class="row mt-4 mixitup-container">
                <div v-for="pkg in filteredPackages" :key="pkg.id" class="col-md-6 col-lg-4 mb-4 mix">
                    <div class="pricingCard">
                        <div class="pricingCard-header text-left">
                            <h4 class="pricingCard-title">{{ pkg.name }}</h4>
                            <p class="pricingCard-text" v-html="pkg.details"></p>
                        </div>
                        <div class="pricingCard-body text-left">
                            <!-- Display the correct price based on selected type -->
                            <h2 id="free-price">
                                ${{ pkg.pricing[selectedType] }}
                            </h2>
                            <p class="pricing-period">/ {{ selectedType }}</p>
                        </div>
                        <ul>
                            <li v-for="product in pkg.products" :key="product.id" class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="Correct Icon">
                                {{ product.product }}
                            </li>
                        </ul>
                        <div class="pricingCard-footer">
                            <a href="#" @click="handlePackageSelection(pkg, 'free')">Get Free Trial Now</a>
                            <a href="#" @click="handlePackageSelection(pkg, 'buy')">Get Started Now</a>
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
