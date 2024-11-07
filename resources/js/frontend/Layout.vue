<script>

import Navbar from "./Navbar.vue";
import Footer from "./Footer.vue";

export default {
    name: "Layout",

    components: {
        Navbar,
        Footer
    }
}
</script>

<template>
    <div>
        <Navbar/>
        <slot/>
        <Footer/>
    </div>

</template>

<style scoped>

</style>
