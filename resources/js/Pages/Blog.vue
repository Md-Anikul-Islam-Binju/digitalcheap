<template>
    <title>Blog</title>
    <section class="blog-section py-5">
        <div class="container">
            <div class="section-title text-center mb-1">
                <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Blogs</h2>
                <p class="fs-1 fw-medium text-center text-capitalize">Exploring Ideas: From Concept to Creation</p>
            </div>
            <div class="row gy-4 mt-2">
                <!-- Loop through blogs dynamically -->
                <div v-for="(blog, index) in blogs" :key="index" class="col-sm-6 col-md-4 col-xl-3">
                    <div class="card h-100">
                        <!-- Dynamically set image -->
                        <img :src="baseUrl + '/images/blog/' + blog.image" class="card-img-top" :alt="blog.title" />
                        <div class="card-body">
                            <h5 class="card-title">{{ getTruncatedText(blog.title) }}</h5>
                            <p class="card-text" v-html="getTruncatedText(blog.details)"></p>

                                <Link :href="'/blog-details/' + blog.id" class="btn btn-success mt-2" >Learn More</Link>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "Blog",
    layout: Layout,
    props: {
        siteSettings: Object,
        authUser: Object,
        blogs: Array,
    },
    computed: {
        baseUrl() {
            return window.location.origin;
        },
    },
    methods: {
        // Method to truncate the content to 250 words
        getTruncatedText(text) {
            // Remove HTML tags
            let cleanText = text.replace(/<\/?[^>]+(>|$)/g, "");

            // Split the text into words
            const words = cleanText.split(/\s+/);

            // If the text has more than 250 words, truncate it
            if (words.length > 8) {
                return words.slice(0, 8).join(" ") + " ...";
            }

            return cleanText; // Return original text if it's less than 250 words
        },
    },
}
</script>

<style scoped>
/* Add your styles if necessary */
</style>
