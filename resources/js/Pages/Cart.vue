<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "Cart",
    layout: Layout,
    props: {
        cart: Array,
        authUser: Object
    },

    computed: {
        subtotal() {
            return this.cart.reduce((total, item) => {
                const price = item.package_price || item.price || 0; // Ensure price is valid
                const duration = item.duration || 1; // Ensure duration is valid
                const device_access = item.device_access || 1; // Ensure device_access is valid
                return total + price * duration * device_access;
            }, 0);
        },
    },

    methods: {
        increaseDuration(index) {
            if (this.cart[index].duration < 12) {
                this.cart[index].duration++;
                this.updateCartSession(); // Update session on cart change
            }
        },
        decreaseDuration(index) {
            if (this.cart[index].duration > 1) {
                this.cart[index].duration--;
                this.updateCartSession(); // Update session on cart change
            }
        },
        increaseDevice(index) {
            if (this.cart[index].device_access < 2) {
                this.cart[index].device_access++;
                this.updateCartSession(); // Update session on cart change
            }
        },
        decreaseDevice(index) {
            if (this.cart[index].device_access > 1) {
                this.cart[index].device_access--;
                this.updateCartSession(); // Update session on cart change
            }
        },
        removeFromCart(index) {
            this.cart.splice(index, 1);
            this.updateCartSession(); // Update session after removing item
        },
        updateCartSession() {
            // Send the updated cart data to the server to save in the session
            this.$inertia.post('/cart/update', {
                cart: this.cart
            }).then(() => {
                console.log('Cart updated successfully.');
            }).catch(error => {
                console.error('Error updating cart:', error);
            });
        }
    }
};
</script>


<template>
    <title>Cart</title>

    <div class="section-title text-center mb-1">
        <br>
        <h2 class="text-center h6 d-inline-block bg-prmry fw-medium mb-2 px-2 py-1">Cart</h2>
        <p class="fs-1 fw-medium text-center ">Buy your tools and enjoy service</p>
    </div>

    <div class="container padding-bottom-3x mb-1 pt-5">
        <!-- Shopping Cart-->
        <div class="table-responsive shopping-cart">
            <table class="table">
                <thead>
                <tr>
                    <th>Item Name</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Details</th>
                    <th class="text-center">Total Price</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>


                <tr v-for="(cartData, index) in cart" :key="index">
                    <template v-if="cartData.product_id">
                        <td>
                            <div class="product-item">
                                <a class="product-thumb" href="#">
                                    <img :src="cartData.image" alt="Product" />
                                </a>
                                <div class="product-info">
                                    <h4 class="product-title">
                                        <a href="#">{{ cartData.name }}</a>
                                    </h4>
                                </div>
                            </div>
                        </td>
                        <td class="text-center text-lg text-medium">{{ cartData.price }}</td>
                        <td class="text-center text-lg text-medium">
                            <!-- Duration and Devices Counters -->
                            <div class="d-flex flex-column w-100 align-items-center gap-2 py-1 py-lg-0">
                                <div class="d-inline-flex align-items-center gap-2">
                                    Duration:
                                    <div class="d-inline-flex align-items-center gap-2">
                                        <button @click="decreaseDuration(index)" class="btn btn-outline-success btn-sm">-</button>
                                        {{ cartData.duration }}
                                        <button @click="increaseDuration(index)" class="btn btn-outline-success btn-sm">+</button>
                                    </div>
                                </div>
                                <div class="d-inline-flex align-items-center gap-3 flex-shrink-0 text-nowrap">
                                    Device:
                                    <div class="d-inline-flex align-items-center gap-2">
                                        <button @click="decreaseDevice(index)" class="btn btn-outline-success btn-sm">-</button>
                                        {{ cartData.device_access }}
                                        <button @click="increaseDevice(index)" class="btn btn-outline-success btn-sm">+</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center text-lg text-medium">
                            {{ cartData.price * cartData.duration * cartData.device_access }}
                        </td>
                        <td class="text-center">
                            <a class="remove-from-cart" href="#" @click="removeFromCart(index)">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </template>


                    <template v-else-if="cartData.package_id">
                        <td>
                            <div class="product-item">
                                <div class="product-info">
                                    <h4 class="product-title">
                                        <a href="#">Package #{{ cartData.name }}</a>
                                    </h4>
                                </div>
                            </div>
                        </td>
                        <td class="text-center text-lg text-medium">
                            {{ cartData.package_price || 0 }} <!-- Fallback to 0 if the price is undefined -->
                        </td>
                        <td class="text-center text-lg text-medium">
                            <div class="d-flex flex-column w-100 align-items-center gap-2 py-1 py-lg-0">
                                <div>Type: {{ cartData.package_type }} | Duration: {{ cartData.package_duration }}</div>
                                <!-- Devices Counter -->
                                <div class="d-inline-flex align-items-center gap-2 flex-shrink-0 text-nowrap">
                                    Device :
                                    <div class="d-inline-flex align-items-center gap-1 gap-md-2">
                                        <button @click="decreaseDevice(index)" class="btn btn-outline-success btn-sm">-</button>
                                        {{ cartData.device_access }}
                                        <button @click="increaseDevice(index)" class="btn btn-outline-success btn-sm">+</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center text-lg text-medium">
                            {{ (cartData.package_price || 0) * (cartData.device_access || 1) }} <!-- Fallback to 1 if device_access is missing -->
                        </td>

                        <td class="text-center">
                            <a class="remove-from-cart" href="#" @click="removeFromCart(index)">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </template>



                </tr>
                </tbody>
            </table>
        </div>
        <div class="shopping-cart-footer">
            <div class="column">
                <form class="coupon-form" method="post">
                    <input class="form-control form-control-sm" type="text" placeholder="Coupon code" required="">
                    <button class="btn btn-outline-success btn-sm" type="submit">Apply Coupon</button>
                </form>
            </div>
            <div class="column text-lg">Subtotal:
                <span class="text-medium">${{ subtotal }}</span>
            </div>

        </div>
        <div class="shopping-cart-footer">
            <div class="column">
                <a class="btn btn-outline-secondary" href="#">
                    <i class="icon-arrow-left"></i>&nbsp;Back to Shopping
                </a>
            </div>
            <div class="column">
                <Link class="btn btn-success" href="/checkout">Checkout</Link>
            </div>
        </div>
    </div>
</template>

<style scoped>
.shopping-cart,
.wishlist-table,
.order-table {
    margin-bottom: 20px
}

.shopping-cart .table,
.wishlist-table .table,
.order-table .table {
    margin-bottom: 0
}

.shopping-cart .btn,
.wishlist-table .btn,
.order-table .btn {
    margin: 0
}

.shopping-cart>table>thead>tr>th,
.shopping-cart>table>thead>tr>td,
.shopping-cart>table>tbody>tr>th,
.shopping-cart>table>tbody>tr>td,
.wishlist-table>table>thead>tr>th,
.wishlist-table>table>thead>tr>td,
.wishlist-table>table>tbody>tr>th,
.wishlist-table>table>tbody>tr>td,
.order-table>table>thead>tr>th,
.order-table>table>thead>tr>td,
.order-table>table>tbody>tr>th,
.order-table>table>tbody>tr>td {
    vertical-align: middle !important
}

.shopping-cart>table thead th,
.wishlist-table>table thead th,
.order-table>table thead th {
    padding-top: 17px;
    padding-bottom: 17px;
    border-width: 1px
}

.shopping-cart .remove-from-cart,
.wishlist-table .remove-from-cart,
.order-table .remove-from-cart {
    display: inline-block;
    color: #ff5252;
    font-size: 18px;
    line-height: 1;
    text-decoration: none
}



.shopping-cart .product-item,
.wishlist-table .product-item,
.order-table .product-item {
    display: table;
    width: 100%;
    min-width: 150px;
    margin-top: 5px;
    margin-bottom: 3px
}

.shopping-cart .product-item .product-thumb,
.shopping-cart .product-item .product-info,
.wishlist-table .product-item .product-thumb,
.wishlist-table .product-item .product-info,
.order-table .product-item .product-thumb,
.order-table .product-item .product-info {
    display: table-cell;
    vertical-align: top
}

.shopping-cart .product-item .product-thumb,
.wishlist-table .product-item .product-thumb,
.order-table .product-item .product-thumb {
    width: 130px;
    padding-right: 20px
}

.shopping-cart .product-item .product-thumb>img,
.wishlist-table .product-item .product-thumb>img,
.order-table .product-item .product-thumb>img {
    display: block;
    width: 100%
}

@media screen and (max-width: 860px) {

    .shopping-cart .product-item .product-thumb,
    .wishlist-table .product-item .product-thumb,
    .order-table .product-item .product-thumb {
        display: none
    }
}




.shopping-cart .product-item .product-title,
.wishlist-table .product-item .product-title,
.order-table .product-item .product-title {
    margin-bottom: 6px;
    padding-top: 5px;
    font-size: 16px;
    font-weight: 500
}

.shopping-cart .product-item .product-title>a,
.wishlist-table .product-item .product-title>a,
.order-table .product-item .product-title>a {
    transition: color .3s;
    color: #374250;
    line-height: 1.5;
    text-decoration: none
}

.shopping-cart .product-item .product-title>a:hover,
.wishlist-table .product-item .product-title>a:hover,
.order-table .product-item .product-title>a:hover {
    color: #0da9ef
}

.shopping-cart .product-item .product-title small,
.wishlist-table .product-item .product-title small,
.order-table .product-item .product-title small {
    display: inline;
    margin-left: 6px;
    font-weight: 500
}

.wishlist-table .product-item .product-thumb {
    display: table-cell !important
}

@media screen and (max-width: 576px) {
    .wishlist-table .product-item .product-thumb {
        display: none !important
    }

    .shopping-cart .product-item .product-title {
        font-size: 10px;
    }

    .shopping-cart .product-item,
    .wishlist-table .product-item,
    .order-table .product-item {
        min-width: 60px;
    }

    .shopping-cart>table>thead>tr>th,
    .shopping-cart>table>thead>tr>td,
    .shopping-cart>table>tbody>tr>th,
    .shopping-cart>table>tbody>tr>td,
    .wishlist-table>table>thead>tr>th,
    .wishlist-table>table>thead>tr>td,
    .wishlist-table>table>tbody>tr>th,
    .wishlist-table>table>tbody>tr>td,
    .order-table>table>thead>tr>th,
    .order-table>table>thead>tr>td,
    .order-table>table>tbody>tr>th,
    .order-table>table>tbody>tr>td {
        font-size: 10px;
    }

    .table>:not(caption)>*>* {
        padding: 0px .5rem;
    }

    .form-control {
        font-size: 10px;
    }

    .btn-group-sm>.btn,
    .btn-sm {
        --bs-btn-padding-y: 1px;
        --bs-btn-padding-x: 6px;
    }
}

.form-control {
    padding: .375rem 4px;
}

.shopping-cart-footer {
    display: table;
    width: 100%;
    padding: 10px 0;
    border-top: 1px solid #e1e7ec
}

.shopping-cart-footer>.column {
    display: table-cell;
    padding: 5px 0;
    vertical-align: middle
}

.shopping-cart-footer>.column:last-child {
    text-align: right
}

.shopping-cart-footer>.column:last-child .btn {
    margin-right: 0;
    margin-left: 15px
}

@media (max-width: 768px) {
    .shopping-cart-footer>.column {
        display: block;
        width: 100%
    }

    .shopping-cart-footer>.column:last-child {
        text-align: center
    }

    .shopping-cart-footer>.column .btn {
        width: 100%;
        margin: 12px 0 !important
    }
}

.coupon-form .form-control {
    display: inline-block;
    width: 100%;
    max-width: 235px;
    margin-right: 12px;
}

.form-control-sm:not(textarea) {
    height: 36px;
}
</style>
