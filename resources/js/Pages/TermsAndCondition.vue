<script>
import Layout from "../frontend/Layout.vue";
export default {
    name: "TermsAndCondition",
    layout: Layout,
    props: {
        siteSettings: Object,
        authUser: Object,
        termsAndCondition: Object,

    }

}
</script>

<template>
    <title>Terms & Condition</title>
    <br><br>
    <section class="py-8">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 col-12">
                    <!-- text center -->
                    <div class="text-center">
                        <h4 class="display-4 fw-bold">Terms & Conditions</h4>
                        <p class="lead px-8">Read our terms below to learn more about your rights and responsibilities as a Product Name user.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-8">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="py-3 mb-5 border-bottom">
                    </div>
                    <p class="fs-4 mb-4" v-html="termsAndCondition.details"> </p>
                </div>
            </div>
        </div>
    </section>
    <br><br>

</template>

<style scoped>

</style>

