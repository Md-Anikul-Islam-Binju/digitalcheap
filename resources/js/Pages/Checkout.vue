<template>
<!--    <div>-->
<!--        <h2>Checkout</h2>-->

<!--        <div class="cart-summary">-->
<!--            &lt;!&ndash; Loop through each cart item &ndash;&gt;-->
<!--            <div v-for="(item, index) in cart" :key="index" class="cart-item">-->
<!--                <h4>{{ item.name }}</h4>-->

<!--                &lt;!&ndash; Display details for Products &ndash;&gt;-->
<!--                <div v-if="item.product_id">-->
<!--                    <p>Price: ${{ item.price }}</p>-->
<!--                    <p>Duration: {{ item.duration }} months</p>-->
<!--                    <p>Devices: {{ item.device_access }}</p>-->
<!--                    <p>Total: ${{ (item.price * item.duration * item.device_access).toFixed(2) }}</p>-->
<!--                </div>-->

<!--                &lt;!&ndash; Display details for Packages &ndash;&gt;-->
<!--                <div v-else-if="item.package_id">-->
<!--                    <p>Package Price: ${{ item.package_price }}</p>-->
<!--                    <p>Duration: {{ item.package_duration }}</p>-->
<!--                    <p>Devices: {{ item.device_access }}</p>-->
<!--                    <p>Total: ${{ (item.package_price * item.device_access).toFixed(2) }}</p>-->
<!--                </div>-->
<!--            </div>-->

<!--            &lt;!&ndash; Total Summary Section &ndash;&gt;-->
<!--            <div class="total-summary">-->
<!--                <h3>Subtotal: ${{ subtotal.toFixed(2) }}</h3>-->
<!--                <h3>Delivery Fee: $10.00</h3>-->
<!--                <h3>Total: ${{ finalTotal.toFixed(2) }}</h3>-->
<!--            </div>-->

<!--            &lt;!&ndash; Payment Method Selection &ndash;&gt;-->
<!--            <form @submit.prevent="placeOrder">-->
<!--                <div class="payment-method">-->
<!--                    <label for="payment_method">Select Payment Method</label>-->
<!--                    <select v-model="paymentMethod" id="payment_method" class="form-control">-->
<!--                        <option value="credit_card">Credit Card</option>-->
<!--                        <option value="paypal">PayPal</option>-->
<!--                        <option value="bank_transfer">Bank Transfer</option>-->
<!--                    </select>-->
<!--                </div>-->

<!--                <button type="submit" class="btn btn-success">Place Order</button>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->





    <div class="container">
        <div class="row mt-3 mt-5">
            <div class="col-md-6 mb-3 mb-md-0">
                <h2 class="fs-2 text-success mb-2 mb-md-3">Product Info</h2>
                <div v-for="(item, index) in cart" :key="index" class="d-flex flex-column gap-4">
                    <div v-if="item.product_id" class="product-info my-2" >
                        <h4>{{ item.name }}</h4>
                        <p>Duration: <span>{{ item.duration }}</span></p>
                        <p>Price: <span>${{ item.price }}</span></p>
                        <p>Device: <span>{{ item.device_access }}</span></p>
                        <p>Sub-Total Price: <span> ${{ (item.price * item.duration * item.device_access).toFixed(2) }}</span></p>
                    </div>

                    <div v-else-if="item.package_id" class="product-info my-2">
                        <h4>Artificial Intelligence</h4>
                        <p>Duration: <span>{{ item.package_duration }}</span></p>
                        <p>Price: <span>${{ item.package_price }}</span></p>
                        <p>Device: <span>{{ item.device_access }}</span></p>
                        <p>Sub-Total Price: <span>${{ (item.package_price * item.device_access).toFixed(2) }}</span></p>
                    </div>
                </div>
                <div class="column border-top border-2">
                    Subtotal: <span class="">${{ subtotal.toFixed(2) }}</span>
                    <p class="delivery-fee">
                        <strong>Total: <span class="">${{ subtotal.toFixed(2) }}</span></strong>
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <h2 class="fs-2 text-success mb-2 mb-md-3">Payment Info</h2>
                <div class="payment-info">
                    <div class="payment-method">
                        <form @submit.prevent="placeOrder" class="coupon-form mt-3" method="post">
                            <select
                                name="paymentMethod"
                                class="form-control"
                                v-model="paymentMethod"
                                id="payment_method"


                            >
                                <option value="" aria-required="true">
                                    Payment Method
                                </option>
                                <option value="cash">Hand Cash</option>
                                <option value="bkash">Bkash</option>
                                <option value="card">Card</option>
                            </select>
                            <input
                                class="form-control my-3"
                                type="text"
                                placeholder="Your Bkash Number"

                            />
                            <div class="row gy-3">
                                <div class="col-12">
                                    <label for="cc-name" class="form-label"
                                    >Name on card</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="cc-name"
                                        placeholder=""

                                    />
                                    <small class="text-body-secondary"
                                    >Full name as displayed on card</small
                                    >
                                    <div class="invalid-feedback">
                                        Name on card is required
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="cc-number" class="form-label"
                                    >Credit card number</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="cc-number"
                                        placeholder=""

                                    />
                                    <div class="invalid-feedback">
                                        Credit card number is required
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="cc-expiration" class="form-label"
                                    >Expiration</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="cc-expiration"
                                        placeholder=""

                                    />
                                    <div class="invalid-feedback">
                                        Expiration date required
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="cc-cvv" class="form-label">CVV</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="cc-cvv"
                                        placeholder=""

                                    />
                                    <div class="invalid-feedback">Security code required</div>
                                </div>
                            </div>
                            <div class="checkout-action text-end mt-3">
                                <div class="check-out-info">
                                    <div class="column">
                                        <button type="submit" class="btn btn-success my-2"
                                        >Place Order</button
                                        >
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
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
