<script>
import Layout from "../frontend/Layout.vue";
export default {
    name: "About",
    layout: Layout
}
</script>

<template>
    <title>About</title>
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

                    <p class="mb-4">Available 24/7/365, we believe that exceptional service is essential. Our team is committed to making your experience smooth and enjoyable. We listen, respond promptly, and offer personalized support to meet your needs. Whether guiding you through options or addressing concerns, we’re here every step of the way. Your satisfaction drives us, and we aim to exceed expectations. With us, you're not just a customer; you’re a valued part of our community.</p>

                    <a href="#" class="btn btn-success">Learn More</a>
                </div>
            </div>
        </div>
    </section>

</template>

<style scoped>

</style>
