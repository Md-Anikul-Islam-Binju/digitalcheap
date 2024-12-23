<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ProductManageController extends Controller
{

    public function products()
    {
        $categories = Category::where('status', 1)->get();
        $products  = Product::latest()->get();
        $siteSettings = SiteSetting::latest()->first();
        $cart = session('cart', []);
        return inertia('Products', compact('products','siteSettings','cart','categories'));
    }


    public function productDetails($id)
    {
        $product = Product::where('id',$id)->first();
        $siteSettings = SiteSetting::latest()->first();
        $allProduct = Product::latest()->get();
        $cart = session('cart', []);
        $auth = auth()->check();
        return inertia('ProductDetails', compact('product','siteSettings','allProduct','cart','auth'));
    }



}
