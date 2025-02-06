<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "SearchProduct",
    layout: Layout,
    props: {
        siteSettings: Object,
        authUser: Object,
        products: Array,
        cart: Array,
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
    <div class="section-products py-5">
        <div class="container">
            <div class="section-title text-center mb-1">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">
                    Search Results for "{{ searchQuery }}"
                </h2>
            </div>
            <div class="row mt-5">
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
</template>

<style scoped>

</style>
