<template>
    <title>Blog Details</title>
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 col-12">
                    <!-- text center -->
                    <div class="text-center">
                        <img :src="baseUrl + '/images/blog/' + blog.image" class="w-full img-fluid mb-3 d-block" alt="" />
                        <h1 class="display-5 fw-bold text-capitalize">{{ blog.title }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->
    <section class="pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 col-12">
                    <!-- date -->
                    <div class="py-3 mb-5 border-bottom">
                        <h3>
                            Published date:
                            <span class="text-primary">{{ formatDate(blog.created_at) }}</span>
                        </h3>
                    </div>
                    <h1 class="fw-bold mb-3">Details:</h1>
                    <p class="fs-4 mb-4" v-html="blog.details"></p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "BlogDetails",
    layout: Layout,
    props:{
        blog: Object,
    },
    computed: {
        baseUrl() {
            return window.location.origin;
        },
    },
    methods: {
        formatDate(date) {
            const options = { day: '2-digit', month: 'short', year: 'numeric' };
            return new Intl.DateTimeFormat('en-US', options).format(new Date(date));
        }
    }
}
</script>

<style scoped>

</style>
