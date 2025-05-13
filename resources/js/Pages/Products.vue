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
        currency: Array
    },
    data() {
        return {
            currentCurrency: localStorage.getItem('currency') || 'TAKA',
            // exchangeRates: {
            //     TAKA: { rate: 1, symbol: '৳' },
            //     USD: { rate: 0.0082, symbol: '$' },
            //     EUR: { rate: 0.0072, symbol: '€' },
            //     INR: { rate: 0.69, symbol: '₹' }
            // },
            exchangeRates: {},
            selectedCategory: null,  // Store the selected category
            selectedType: "Monthly", // Default to "Monthly"
            packageTypes: [
                { value: "Monthly", label: "Monthly" },
                { value: "Half Yearly", label: "Half Yearly" },
                { value: "Yearly", label: "Yearly" },
            ],
        };
    },

    created() {
        this.currency.forEach(item => {
            this.exchangeRates[item.name] = {
                rate: parseFloat(item.value),
                symbol: this.getCurrencySymbol(item.name)
            };
        });
        // Listen for currency changes
        window.addEventListener('currency-changed', (e) => {
            this.currentCurrency = e.detail;
        });
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
        getCurrencySymbol(name) {
            switch (name) {
                case 'BDT': return '৳';
                case 'USD': return '$';
                case 'EUR': return '€';
                case 'INR': return '₹';
                default: return '';
            }
        },


        // formatPrice(price) {
        //     const currency = this.exchangeRates[this.currentCurrency];
        //     return `${currency.symbol}${(price * currency.rate).toFixed(2)}`;
        // },

        formatPrice(price) {
            const currency = this.exchangeRates[this.currentCurrency] || { rate: 1, symbol: '৳' };
            return `${currency.symbol}${(price * currency.rate).toFixed(2)}`;
        },


        // getCurrentPrice(pkg, type) {
        //     if (type === "Monthly") {
        //         return pkg.month_package_discount_amount !== null
        //             ? pkg.month_package_discount_amount
        //             : pkg.month_package_amount;
        //     }
        //     if (type === "Half Yearly") {
        //         return pkg.half_year_package_discount_amount !== null
        //             ? pkg.half_year_package_discount_amount
        //             : pkg.half_year_package_amount;
        //     }
        //     if (type === "Yearly") {
        //         return pkg.yearly_package_discount_amount !== null
        //             ? pkg.yearly_package_discount_amount
        //             : pkg.yearly_package_amount;
        //     }
        //     return 0;
        // },

        getDiscountedPrice(pkg, type) {
            return pkg.pricing[type] || 0;
        },

        // Get the original (non-discounted) price
        getOriginalPrice(pkg, type) {
            // If there’s a discount, get the non-discounted price from backend response
            if (type === "Monthly") return pkg.month_package_amount;
            if (type === "Half Yearly") return pkg.half_year_package_amount;
            if (type === "Yearly") return pkg.yearly_package_amount;
            return 0;
        },

        // Check if a discount exists for the selected type
        isDiscounted(pkg, type) {
            if (type === "Monthly") return pkg.month_package_discount_amount !== null;
            if (type === "Half Yearly") return pkg.half_year_package_discount_amount !== null;
            if (type === "Yearly") return pkg.yearly_package_discount_amount !== null;
            return false;
        },

        loginWithGoogle() {
            window.location.href = '/login/google'; // Redirect to the Laravel route handling Google login
        },
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
                    }).then(() => {
                        location.reload(); // Reload the page after clicking OK
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

        togglePasswordVisibility() {
            this.passwordVisible = !this.passwordVisible;
            const passwordInput = document.getElementById("password");
            if (passwordInput) {
                passwordInput.type = this.passwordVisible ? "text" : "password";
            }
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

                    <button id="google-login" class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="button">
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

                    // Bind Google login button inside SweetAlert modal
                    const googleLoginButton = document.getElementById("google-login");
                    if (googleLoginButton) {
                        googleLoginButton.addEventListener("click", this.loginWithGoogle);
                    }
                },

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
                                     <span v-if="product.discount_amount" class="discount">
                                       {{ ( product.discount_amount / product.amount)*100 }}% off
                                     </span>
                                    <Link class="d-inline-block" :href="`/product-details/${product.id}`">
                                        <img :src="getProductImageUrl(product.file)" alt="Product Image">
                                    </Link>
                                </div>

<!--                                <div class="part-2" v-if="product.discount_amount">-->
<!--                                    <h3 class="product-title">{{ product.name }}</h3>-->
<!--                                    <h4 class="product-old-price text-decoration-line-through">-->
<!--                                        ${{ product.amount }}-->
<!--                                    </h4>-->
<!--                                    <h4 class="product-price">${{ product.discount_amount }}</h4>-->
<!--                                </div>-->
<!--                                <div class="part-2" v-else>-->
<!--                                    <h3 class="product-title">{{ product.name }}</h3>-->
<!--                                    <h4 class="product-price">${{ product.amount }}</h4>-->
<!--                                </div>-->


                                <div class="part-2" v-if="product.discount_amount">
                                    <h3 class="product-title">{{ product.name }}</h3>
                                    <h4 class="product-old-price text-decoration-line-through">
                                        {{ formatPrice(product.amount) }}
                                    </h4>
                                    <h4 class="product-price">{{ formatPrice(product.discount_amount) }}</h4>
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

                            <div class="d-flex gap-2 align-items-center">
                                <h2 id="free-price">
                                    {{ formatPrice(getDiscountedPrice(pkg, selectedType)) }}
                                </h2>

                                <h4 v-if="isDiscounted(pkg, selectedType)" class="text-decoration-line-through text-muted" id="original-price">
                                    {{ formatPrice(getOriginalPrice(pkg, selectedType)) }}
                                </h4>
                            </div>
                            <p class="pricing-period">/ {{ selectedType }}</p>
                        </div>
                        <ul>
                            <li v-for="(product, index) in pkg.products" :key="index" class="d-flex align-items-center">
                                <img src="frontend/images/Correct.svg" alt="Correct Icon">
                                {{ product }} <!-- Display the product name -->
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
