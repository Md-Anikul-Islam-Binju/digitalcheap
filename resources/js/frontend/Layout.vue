<script>

import Navbar from "./Navbar.vue";
import Footer from "./Footer.vue";

export default {
    name: "Layout",
    props: {
        siteSettings: Object,
    },
    components: {
        Navbar,
        Footer
    }
}
</script>

<template>
    <div>
        <Navbar :siteSettings="siteSettings" />
        <slot/>
        <Footer :siteSettings="siteSettings" />
    </div>

</template>

<style scoped>

</style>
