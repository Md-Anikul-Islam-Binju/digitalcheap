<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

//    public function productAddToCart(Request $request)
//    {
//        $request->validate([
//            'product_id' => 'required|exists:products,id',
//            'name' => 'required|string',
//            'price' => 'nullable',
//            'cart_type' => 'required|in:free,buy',
//        ]);
//        $cart = session()->get('cart', []);
//        foreach ($cart as $item) {
//            if ($item['product_id'] == $request->product_id && $item['cart_type'] == $request->cart_type) {
//                return response()->json(['message' => 'Product is already in the cart'], 409);
//            }
//        }
//        $cart[] = [
//            'product_id' => $request->product_id,
//            'name' => $request->name,
//            'price' => $request->price,
//            'cart_type' => $request->cart_type,
//        ];
//        session()->put('cart', $cart);
//        return response()->json(['message' => 'Product added to cart successfully', 'cart' => $cart], 200);
//    }

    public function productAddToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['authenticated' => false, 'message' => 'Please log in to add a product to the cart'], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer|min:1|max:12',
            'device_access' => 'required|integer|min:1|max:2', // Added max:2 for device access
        ]);

        $cart = session()->get('cart', []);

        // Check if the product already exists in the cart
        foreach ($cart as $item) {
            if ($item['product_id'] == $request->product_id) {
                return response()->json(['message' => 'Product is already in the cart'], 409);
            }
        }

        $cart[] = [
            'product_id' => $request->product_id,
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'device_access' => $request->device_access,
        ];

        session()->put('cart', $cart);

        return response()->json(['authenticated' => true, 'message' => 'Product added to cart successfully', 'cart' => $cart], 200);
    }






    public function showProductCart()
    {
        $siteSettings = SiteSetting::where('id', 1)->first();
        $cart = session('cart', []);
        foreach ($cart as &$cartItem) {
            $product = Product::find($cartItem['product_id']);
            if ($product) {
                $cartItem['image'] = asset('images/product/' . $product->file);
            } else {
                $cartItem['image'] = 'https://www.bootdey.com/image/220x180/FF0000/000000';
            }
        }
        dd($cart);
        return inertia('Cart', compact('cart', 'siteSettings'));
    }



}
