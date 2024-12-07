<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CartController extends Controller
{

    public function productAddToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string',
            'price' => 'nullable',
            'cart_type' => 'required|in:free,buy',
        ]);

        $cart = session()->get('cart', []);

        // Check if the product already exists in the cart
        foreach ($cart as $item) {
            if ($item['product_id'] == $request->product_id && $item['cart_type'] == $request->cart_type) {
                return response()->json(['message' => 'Product is already in the cart'], 409);
            }
        }

        $cart[] = [
            'product_id' => $request->product_id,
            'name' => $request->name,
            'price' => $request->price,
            'cart_type' => $request->cart_type,
        ];

        session()->put('cart', $cart);

        return response()->json(['message' => 'Product added to cart successfully', 'cart' => $cart], 200);
    }





    public function showProductCart()
    {
        $cart = session('cart', []);
        dd($cart);
        return inertia('Cart', ['cart' => $cart]);
    }
}
