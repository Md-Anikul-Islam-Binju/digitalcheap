<template>
    <div>
        <h2>Checkout</h2>

        <div class="cart-summary">
            <!-- Loop through each cart item -->
            <div v-for="(item, index) in cart" :key="index" class="cart-item">
                <h4>{{ item.name }}</h4>

                <!-- Display details for Products -->
                <div v-if="item.product_id">
                    <p>Price: ${{ item.price }}</p>
                    <p>Duration: {{ item.duration }} months</p>
                    <p>Devices: {{ item.device_access }}</p>
                    <p>Total: ${{ (item.price * item.duration * item.device_access).toFixed(2) }}</p>
                </div>

                <!-- Display details for Packages -->
                <div v-else-if="item.package_id">
                    <p>Package Price: ${{ item.package_price }}</p>
                    <p>Duration: {{ item.package_duration }}</p>
                    <p>Devices: {{ item.device_access }}</p>
                    <p>Total: ${{ (item.package_price * item.device_access).toFixed(2) }}</p>
                </div>
            </div>

            <!-- Total Summary Section -->
            <div class="total-summary">
                <h3>Subtotal: ${{ subtotal.toFixed(2) }}</h3>
                <h3>Delivery Fee: $10.00</h3>
                <h3>Total: ${{ finalTotal.toFixed(2) }}</h3>
            </div>

            <!-- Payment Method Selection -->
            <form @submit.prevent="placeOrder">
                <div class="payment-method">
                    <label for="payment_method">Select Payment Method</label>
                    <select v-model="paymentMethod" id="payment_method" class="form-control">
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Place Order</button>
            </form>
        </div>
    </div>
</template>

<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "Checkout",
    layout: Layout,
    props: {
        cart: Array,
        subtotal: Number,
        siteSettings:Object,
        authUser:Object,
    },

    data() {
        return {
            paymentMethod: 'credit_card', // Default payment method
        };
    },
    computed: {
        // Compute the final total (including delivery fee)
        finalTotal() {
            return this.subtotal + 10.00;  // Adding a fixed delivery fee of $10
        },
    },
    methods: {
        placeOrder() {
            this.$inertia.post('/checkout/order', {
                payment_method: this.paymentMethod,
            })
                .then(() => {
                    this.$inertia.visit('/payment'); // Redirect to payment page
                })
                .catch((error) => {
                    console.error('Error placing order:', error);
                });
        },
    },
};
</script>

<style scoped>
/* Add any custom styles for your checkout page */
.cart-item {
    margin-bottom: 20px;
}

.total-summary h3 {
    font-weight: bold;
}

.payment-method {
    margin-top: 20px;
}

.btn-success {
    margin-top: 20px;
}
</style>
