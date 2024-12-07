<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ProductManageController extends Controller
{
    public function productDetails($id)
    {
        $product = Product::where('id',$id)->first();
        $siteSettings = SiteSetting::latest()->first();
        $allProduct = Product::latest()->get();
        return inertia('ProductDetails', compact('product','siteSettings','allProduct'));
    }
}
