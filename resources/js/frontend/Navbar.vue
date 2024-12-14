<template>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Thirteenth navbar example">
            <div class="container">

                <div class="d-flex d-lg-none align-items-center justify-content-between w-100">
                    <Link class="navbar-brand d-inline d-lg-none" href="/">
                        <img :src="getLogoUrl(siteSettings?.logo)" style="width: 120px;" alt="">
                    </Link>

                    <div class="d-flex gap-3 align-items-center">
                        <Link class="cart-icon position-relative d-block d-lg-none text-dark" style="width: 30px;">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">3</span>
                            <svg xmlns="http://www.w3.org/2000/svg"  width="30"  height="30"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                        </Link>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </div>

                <div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
                    <a class="navbar-brand col-lg-2 me-0 mt-2 mt-lg-0 d-none d-lg-block" href="/">
                        <img :src="getLogoUrl(siteSettings?.logo)" alt="" style="height: 60px;">
                    </a>

                    <ul class="navbar-nav mx-auto justify-content-lg-center">
                        <li class="nav-item">
                            <Link class="nav-link active" aria-current="page" href="/">Home</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" href="/about">About</Link>
                        </li>

                        <li class="nav-item">
                            <Link class="nav-link" href="/products">ProductHub</Link>
                        </li>
<!--                        <li class="nav-item dropdown ">-->
<!--                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>-->
<!--                            <ul class="dropdown-menu">-->
<!--                                <li><a class="dropdown-item" href="#">SEO</a></li>-->
<!--                                <li><a class="dropdown-item" href="#">Sports</a></li>-->
<!--                                <li><a class="dropdown-item" href="#">AI</a></li>-->
<!--                                <li><a class="dropdown-item" href="#">OTT</a></li>-->
<!--                                <li><a class="dropdown-item" href="#">Combo Offers</a></li>-->
<!--                            </ul>-->
<!--                        </li>-->
                        <li class="nav-item">
                            <a class="nav-link" href="/login"  target="_blank">Login</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/account-registration-for-user"  target="_blank">Sign Up</a>
                        </li>

                    </ul>

                    <div class="d-lg-flex d-flex flex-wrap justify-content-lg-end align-items-center gap-2 mt-1 mt-lg-0">
                        <form role="search" class="form-width">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        </form>
                        <a class="btn btn-outline-success mt-2 mt-lg-0 ">Affiliate</a>

                        <a class="btn btn-success mt-2 mt-lg-0">Live Chat</a>

                        <div class="currency-width shadow-none">
                            <select class="form-select shadow-none rounded border-success" aria-label="Default select example">
                                <option selected>USD</option>
                                <option value="1">EUR</option>
                                <option value="2">INR</option>
                            </select>
                        </div>
                        <div class="cart-icon position-relative d-none d-lg-block" style="width: 30px;">
                            <Link href="/cart">
                                 <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">{{totalCartCount}}</span>
                                 <svg xmlns="http://www.w3.org/2000/svg"  width="30"  height="30"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                            </Link>
                        </div>
                    </div>


                </div>
            </div>
        </nav>
    </header>
</template>
<script>
export default {
    name: "Navbar",
    props: {
        siteSettings: Object,
        cart : Array,
    },
    computed: {
        totalCartCount() {
            // Calculates the total cart count dynamically
            return this.cart.reduce((total, item) => total + (item.quantity || 1), 0);
        },
    },

    methods:{
        getLogoUrl(logoPath) {
            if (!logoPath) {
                return 'default-logo.png';
            }
            return `${window.location.origin}/${logoPath}`;
        },
    },
    mounted() {
        console.log("Cart data:", this.cart);
    }
}
</script>
<style scoped>

</style>
