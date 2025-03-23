<script>
import Layout from "../frontend/Layout.vue";
export default {
    name: "HowToUse",
    props:{
        siteSettings:Object,
        authUser:Object,
    },

    layout: Layout,
    methods: {
        getEmbeddedYouTubeUrl(link) {
            if (!link) return ''; // Return an empty string if link is not available

            const videoIdMatch = link.match(/(?:youtu\.be\/|youtube\.com\/(?:.*v=|embed\/|v\/|.*[?&]v=))([^?&]+)/);
            const videoId = videoIdMatch ? videoIdMatch[1] : null;

            return videoId ? `https://www.youtube.com/embed/${videoId}` : '';
        },
    },


}
</script>

<template>
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 col-12">
                    <!-- text center -->
                    <div  class="text-center">
                        <iframe class="w-100" width="560" height="460" :src="getEmbeddedYouTubeUrl(siteSettings.how_to_use_link)" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <h1 class="display-5 fw-bold text-capitalize mt-3">How to Create a netflix account</h1>
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
                    </div>
                      <p class="fs-4 mb-4" v-html="siteSettings.how_to_use"> </p>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
