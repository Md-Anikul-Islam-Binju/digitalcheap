<script>

import Navbar from "./Navbar.vue";
import Footer from "./Footer.vue";

export default {
    name: "Layout",
    props: {
        siteSettings: Object,
        cart:Array,
    },
    components: {
        Navbar,
        Footer
    },
}
</script>

<template>
    <div>
        <Navbar :siteSettings="siteSettings" :cart="cart" />
        <slot/>
        <Footer :siteSettings="siteSettings" />
    </div>

</template>

<style scoped>

</style>
