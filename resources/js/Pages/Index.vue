<script>
import Layout from "../frontend/Layout.vue";
import Swal from "sweetalert2";


export default {
    name: "Index",
    layout: Layout,
    props:{
        sliders:Array,
        categories: Array,
        packages: Array,
        products: Array,
        services: Array,
        reviews: Array,
        siteSettings: Object,
        partner : Array,
        auth: Boolean,
        mostSellingProducts: Array,
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
            isModalOpen: false,
            videoUrl: "",
            selectedCategory: null, // Default to show all categories
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
        filteredPackages() {
            return this.packages.filter((pkg) => {
                const matchesCategory =
                    !this.selectedCategory || parseInt(pkg.category_id) === this.selectedCategory;
                const matchesType = pkg.package_types.includes(this.selectedType);

                return matchesCategory && matchesType;
            });
        },
    },

    methods:{
        getCurrencySymbol(name) {
            switch (name) {
                case 'BDT': return '৳';
                case 'USD': return '$';
                case 'EUR': return '€';
                case 'INR': return '₹';
                default: return '';
            }
        },
        formatPrice(price) {
            const currency = this.exchangeRates[this.currentCurrency] || { rate: 1, symbol: '৳' };
            return `${currency.symbol}${(price * currency.rate).toFixed(2)}`;
        },
        // formatPrice(price) {
        //     const currency = this.exchangeRates[this.currentCurrency];
        //     return `${currency.symbol}${(price * currency.rate).toFixed(2)}`;
        // },

        getEmbeddedYouTubeUrl(link) {
            if (!link) return ''; // Return an empty string if link is not available
            const videoIdMatch = link.match(/(?:youtu\.be\/|youtube\.com\/(?:.*v=|embed\/|v\/|.*[?&]v=))([^?&]+)/);
            const videoId = videoIdMatch ? videoIdMatch[1] : null;
            return videoId ? `https://www.youtube.com/embed/${videoId}` : '';
        },

        getDiscountedPrice(pkg, type) {
            return pkg.pricing[type] || 0; // If discount is available, it is already stored in pkg.pricing[type]
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
        getSliderUrl(sliderPath) {
            if (!sliderPath) {
                return 'frontend/images/file.jpg';
            }
            const fullUrl = `${window.location.origin}/images/slider/${sliderPath}`;
            return fullUrl;
        },

        getServiceImageUrl(serviceImagePath) {
            if (!serviceImagePath) {
                return 'frontend/images/file.jpg'; // Fallback image
            }
            return `${window.location.origin}/images/service/${serviceImagePath}`;
        },

        getProductImageUrl(productImagePath) {
            if (!productImagePath) {
                return 'frontend/images/file.jpg'; // Fallback image
            }
            return `${window.location.origin}/images/product/${productImagePath}`;
        },

        getReviewImageUrl(reviewImagePath) {
            if (!reviewImagePath) {
                return 'frontend/images/file.jpg'; // Fallback image
            }
            return `${window.location.origin}/images/client/${reviewImagePath}`;
        },


        getPartnerImageUrl(partnerImagePath) {
            if (!partnerImagePath) {
                return 'frontend/images/file.jpg'; // Fallback image
            }
            return `${window.location.origin}/images/partner/${partnerImagePath}`;
        },
        togglePasswordVisibility() {
            this.passwordVisible = !this.passwordVisible;
            const passwordInput = document.getElementById("password");
            if (passwordInput) {
                passwordInput.type = this.passwordVisible ? "text" : "password";
            }
        },
        selectCategory(categoryId) {
            this.selectedCategory = categoryId;
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

        // openVideoModal(videoUrl) {
        //     this.$refs.videoIframe.src = videoUrl;
        //     const modal = new bootstrap.Modal(this.$refs.videoModal);
        //     modal.show();
        // },
        // closeVideoModal() {
        //     this.$refs.videoIframe.src = '';
        // },
        openModal(videoUrl) {
            this.videoUrl = videoUrl;
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
            this.videoUrl = "";
        },

        normalizeYouTubeLink(link) {
            if (!link) return '';

            // If it's already a full watch URL, return as is
            if (link.includes('watch?v=')) return link;

            // If it's a youtu.be short link → convert to watch?v= format
            const match = link.match(/youtu\.be\/([^?]+)/);
            if (match && match[1]) {
                return `https://www.youtube.com/watch?v=${match[1]}`;
            }

            // Otherwise return original
            return link;
        }



    },

}
</script>

<template>
    <title>Digitalcheap Home</title>
    <!-- hero section -->



    <section class="hero-section">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true"
            data-bs-interval="5000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <div v-for="(sliderData, index) in sliders" :key="sliderData.id"
                    :class="['carousel-item', { active: index === 0 }]">

                    <a :href="sliderData.link" target="_blank" rel="noopener noreferrer" class="d-block">

                        <div class="position-relative">
                            <div class="container">
                                <div class="slider-content position-absolute" style="top: 15%; max-width:
                                500px; width: 100%">
                                    <h2 class="text-white w-100">{{sliderData.title}}</h2>
                                </div>
                            </div>
                            <img :src="getSliderUrl(sliderData.file)" class="d-block w-100 object-fit-cover" alt="...">
                        </div>

                    </a>

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
            <div
                class="row align-items-center mt-md-5 justify-content-center gap-2 gap-md-0 justify-content-md-between">
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

                    <p class="mb-4">Available 24/7/365, we believe that exceptional service is essential. Our team is
                        committed to making your experience smooth and enjoyable. We listen, respond promptly, and offer
                        personalized support to meet your needs. Whether guiding you through options or addressing
                        concerns, we’re here every step of the way. Your satisfaction drives us, and we aim to exceed
                        expectations. With us, you're not just a customer; you’re a valued part of our community.</p>

                    <Link href="/about" class="btn btn-success">Learn More</Link>
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
                <div v-for="(servicesData, index) in services" :key="index" class="col-sm-6 col-lg-3">
                    <div class="featured-box px-md-4 text-center mb-4">
                        <div class="featured-box-icon">
                            <img :src="getServiceImageUrl(servicesData.file)" class="mx-auto img-fluid object-fit-cover rounded"
                                alt="">
                        </div>
                        <h4 class="fw-600 mb-3">{{ servicesData.name }}</h4>
                        <p class="text-muted mb-0" style="line-height: 1.8;" v-html="servicesData.details"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- our partner section -->
    <section class="our-partner py-5 d-flex justify-content-center">
        <div class="container">
            <div class="section-title text-center mb-3">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Our Partner</h2>
                <p class="fs-1 fw-medium text-center text-capitalize">Collaborating for Growth</p>
            </div>
            <div class="partner-slider-section overflow-hidden">
                <div class="slider-main d-flex align-items-center justify-content-center">

                        <div class="slider-item d-flex align-items-center">
                            <span v-for="partnerData in partner" :key="partnerData.id">
                                   <a :href="partnerData.link" target="_blank">
                                    <img style="width: 250px;" :src="getPartnerImageUrl(partnerData.file)" alt="">
                                   </a>
                            </span>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Usability -->

    <section class="usability-section py-5">
        <div class="container">
            <div class="section-title text-center mb-1">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Usability</h2>
                <p class="fs-1 fw-medium text-center text-capitalize">Designed for Your Ease</p>
            </div>
            <div class="row align-items-center mt-2">
                <div class="col-12 col-md-6 text-center p-3 mt-3 mt-md-0">
                    <div class="use-card p-4 shadow-lg rounded">
                        <a class="popup-youtube my-video-links"  :href="normalizeYouTubeLink(siteSettings.how_to_use_link)">
                            <i class="fa-solid fa-circle-play"></i>
                        </a>
                        <h3 class="fw-bold text-center mb-4">How to Use</h3>
                        <p class="text-muted" v-html="siteSettings.how_to_use"></p>
                        <Link href="/how-to-use" class="text-prmry more-btn">
                            Learn More <i class="fas fa-arrow-right ri"></i>
                        </Link>
                    </div>
                </div>
                <div class="col-12 col-md-6 text-center mt-2 mt-md-0 p-3">
                    <div class="use-card p-4 shadow-lg rounded">
                        <a class="popup-youtube my-video-links" :href="normalizeYouTubeLink(siteSettings.how_to_access_link)">
                            <i class="fa-solid fa-circle-play"></i>
                        </a>
                        <h3 class="fw-bold text-center mb-4">How to Access</h3>
                        <p class="text-muted" v-html="siteSettings.how_to_access"></p>
                        <Link href="/how-to-access" class="text-prmry more-btn">
                            Learn More <i class="fas fa-arrow-right ri"></i>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Our product section -->
    <div class="section-products py-5">
        <div class="container">
            <div class="section-title text-center mb-1">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">
                    Our Product
                </h2>
                <p class="fs-1 fw-medium text-center text-capitalize">
                    Quality You Can Rely On
                </p>
            </div>
            <div class="row mt-5">
                <!-- Dynamic Products -->
                <div v-for="(product, index) in products" :key="index" class="col-md-6 col-lg-4 col-xl-3">
                    <div :id="'product-' + product.id" class="single-product">
                        <div class="part-1">
                            <span v-if="product.discount_amount" class="discount">
                                {{ ( product.discount_amount / product.amount)*100 }}% off
                            </span>
                            <Link class="d-inline-block" :href="`/product-details/${product.id}`">
                            <img :src="getProductImageUrl(product.file)" alt="Product Image">
                            </Link>
                        </div>

<!--                        <div class="part-2" v-if="product.discount_amount">-->
<!--                            <h3 class="product-title">{{ product.name }}</h3>-->
<!--                            <h4 class="product-old-price text-decoration-line-through">-->
<!--                                ${{ product.amount }}-->
<!--                            </h4>-->
<!--                            <h4 class="product-price">${{ product.discount_amount }}</h4>-->
<!--                        </div>-->

<!--                        <div class="part-2" v-else>-->
<!--                            <h3 class="product-title">{{ product.name }}</h3>-->
<!--                            <h4 class="product-price">${{ product.amount }}</h4>-->
<!--                        </div>-->
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

    <!-- Best Seller Section -->
    <section v-if="mostSellingProducts" class="best-seller py-5 section-products">
        <div class="container">
            <div class="section-title text-center mb-1">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Best Sells</h2>
            </div>
            <div class="row mt-5 my-slider">
                <div v-for="(product, index) in mostSellingProducts" :key="index" class="col-md-6 col-lg-4 col-xl-3">
                    <div :id="'product-' + product.id" class="single-product">
                        <div class="part-1">
                            <span v-if="product.discount_amount" class="discount">
                                {{ ( product.discount_amount / product.amount)*100 }}% off
                            </span>
                            <Link class="d-inline-block" :href="`/product-details/${product.id}`">
                                <img :src="getProductImageUrl(product.file)" alt="Product Image">
                            </Link>
                        </div>

<!--                        <div class="part-2" v-if="product.discount_amount">-->
<!--                            <h3 class="product-title">{{ product.name }}</h3>-->
<!--                            <h4 class="product-old-price text-decoration-line-through">-->
<!--                                ${{ product.amount }}-->
<!--                            </h4>-->
<!--                            <h4 class="product-price">${{ product.discount_amount }}</h4>-->
<!--                        </div>-->

<!--                        <div class="part-2" v-else>-->
<!--                            <h3 class="product-title">{{ product.name }}</h3>-->
<!--                            <h4 class="product-price">${{ product.amount }}</h4>-->
<!--                        </div>-->
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
    </section>

    <!-- Combo Offers -->
    <section class="pricing">
        <div class="container">
            <div class="section-title text-center mb-3">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Combo Offers</h2>
                <p class="fs-1 fw-medium text-center text-capitalize">Choose a plan that’s right for you</p>
            </div>

            <!-- Package Type Filter -->
            <div class="d-flex justify-content-center align-items-center gap-3 switch-content">
                <div class="form-check form-check-inline" v-for="(type, index) in packageTypes" :key="index">
                    <input class="form-check-input" type="radio" :value="type.value" v-model="selectedType"
                        :id="'type-' + index" />
                    <label class="form-check-label" :for="'type-' + index">{{ type.label }}</label>
                </div>
            </div>

            <!-- Category Tabs -->
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation" v-for="category in categories" :key="category.id">
                    <button class="nav-link" :class="{ active: selectedCategory === category.id }"
                        @click="selectCategory(category.id)">
                        {{ category.name }}
                    </button>
                </li>
            </ul>

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
<!--                            <div class="d-flex gap-2 align-items-center">-->
<!--                                <h2 id="free-price">-->
<!--                                    ${{ getDiscountedPrice(pkg, selectedType) }}-->
<!--                                </h2>-->

<!--                                <h4 v-if="isDiscounted(pkg, selectedType)" class="text-decoration-line-through text-muted" id="original-price">-->
<!--                                    ${{ getOriginalPrice(pkg, selectedType) }}-->
<!--                                </h4>-->
<!--                            </div>-->
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

    <section class="customer-review py-5">
        <div class="container">
            <div class="row">
                <div class="section-title text-center mb-3">
                    <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Client's Review</h2>
                    <p class="fs-1 fw-medium text-center text-capitalize">Voices of Satisfaction</p>
                </div>
            </div>
        </div>
        <div class="partner-slider-section">
            <div class="slider-main d-flex align-items-center justify-content-center">
                <div class="slider-item d-flex align-items-center">

                    <div v-for="reviewData in reviews" :key="reviewData.id" class="col-lg-4 text-center" style="width: 100%">
                        <div class="review-card p-4 mx-auto">
                            <img :src="getReviewImageUrl(reviewData.file)" class="mb-3"
                                 style="border-radius: 50%; width: 80px; height: 80px; object-fit: cover;" alt="">
                            <p class="text-secondary text-center mb-3"
                               style="height: 80px; overflow: hidden; text-overflow: ellipsis; font-size: 16px; line-height: 1.4;"
                               v-html="reviewData.message"></p>
                            <div class="text-center">
                                <h2 class="fw-medium text-success mb-1" style="font-size: 18px; line-height: 1.2;">
                                    {{ reviewData.name }}
                                </h2>
                                <p style="font-size: 14px; margin: 0; color: #666;">
                                    {{ reviewData.designation }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
     </section>


</template>

<style scoped>
.slider-content h2{
    @media (max-width: 768px){
        font-size: 1.25rem;
    }
}
</style>


