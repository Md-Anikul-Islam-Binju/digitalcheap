<template>
    <footer class="footer-section bg-dark text-white">
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <a href="/" class="footer-logo">
                            <img :src="getLogoUrl(siteSettings?.logo)" alt="" style="height: 60px;">
                        </a>
                        <div class="footer-desc">Digital cheap listen, respond promptly, and offer personalized support to meet your needs.</div>
                        <div class="social-icons">
                            <a :href="siteSettings.twitter_link" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                            <a :href="siteSettings.facebook_link" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                            <a :href="siteSettings.instagram_link" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                            <a :href="siteSettings.youtube_link" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                            <a :href="siteSettings.linkedin_link" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a :href="siteSettings.pinterest_link" target="_blank"><i class="fa-brands fa-pinterest-p"></i></a>
                        </div>
                    </div>
                    <div class="col-6 mt-3 mt-md-0 col-md-2">
                        <div class="useful-links">
                            <h5 class="footer-heading">Useful Links</h5>
                            <ul>
                                <li>
                                    <Link href="/">Home</Link>
                                </li>
                                <li>
                                    <Link href="/about">About</Link>
                                </li>
                                <li>
                                    <Link href="/blog">Blog</Link>
                                </li>
                                <li>
                                    <Link href="/terms-condition">Terms of Conditions</Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6 mt-3 mt-md-0 col-md-2">
                        <div class="our-services">
                            <h5 class="footer-heading">Our Services</h5>
                            <ul>
                                <li><a href="#">SEO</a></li>
                                <li><a href="#">OTT</a></li>
                                <li><a href="#">Sports</a></li>
                                <li><a href="#">AI</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-4 mt-md-0 text-center text-md-start col-md-3">
                        <div class="contact-info">
                            <h5><span>Phone: </span>{{siteSettings.phone}}</h5>
                            <h5><span>Email: </span>{{siteSettings.email}}</h5>
                            <p class="address">
                                {{siteSettings.address}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <img src="frontend/images/payment-gateways.jpg" class="w-100 img-fluid" alt="payment">
                </div>
                <div class="row">
                    <div class="col-lg-6 mx-auto text-center" >
                        <p class="mt-3" style="line-height: 1.8;">Copyright © 2025 <a class="fw-600" style="color: #00fe9c;" href="/">CoderNetix</a>. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
<script>
export default {
    name: "Footer",
    props:{
        siteSettings:Object
    },
    methods:{
        getLogoUrl(logoPath) {
            if (!logoPath) {
                return 'default-logo.png';
            }
            return `${window.location.origin}/${logoPath}`;
        },

    }
}
</script>
<style scoped>

</style>
