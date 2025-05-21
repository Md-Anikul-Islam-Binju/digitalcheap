<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Package;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ProductManageController extends Controller
{

    public function products()
    {
        $categories = Category::where('status', 1)->where('type', 'product')->get();
        $categoriesPackage = Category::where('status',1)->where('type', 'package')->latest()->get();
        $products  = Product::latest()->get();
        $packages = Package::where('status',1)->latest()->get();
        foreach ($packages as $package) {
            $package->package_types = json_decode($package->package_type);
            $pricing = [];
            if ($package->month_package_discount_amount) {
                $pricing['Monthly'] = $package->month_package_discount_amount;
            } else {
                $pricing['Monthly'] = $package->month_package_amount;
            }
            if ($package->half_year_package_discount_amount) {
                $pricing['Half Yearly'] = $package->half_year_package_discount_amount;
            } else {
                $pricing['Half Yearly'] = $package->half_year_package_amount;
            }
            if ($package->yearly_package_discount_amount) {
                $pricing['Yearly'] = $package->yearly_package_discount_amount;
            } else {
                $pricing['Yearly'] = $package->yearly_package_amount;
            }
            $package->pricing = $pricing;
        }
        foreach ($packages as $packageInfo) {
            // Decode employee_id
            $productIds = json_decode($packageInfo->product_id);

            if (is_array($productIds)) {
                // Fetch the email and domain_verification_id as an array
                $selectedProduct = Product::whereIn('id', $productIds)
                    ->pluck('name')
                    ->toArray();
                $packageInfo->products = $selectedProduct;
            } else {
                $packageInfo->products = [];
            }
        }
        $siteSettings = SiteSetting::latest()->first();
        $cart = session('cart', []);
        $authUser = auth()->user();
        $auth = auth()->check();
        $currency = Currency::where('status', 1)->get();
        return inertia('Products', compact('products','siteSettings','cart','categories','authUser','packages','auth','currency','categoriesPackage'));
    }


    public function productDetails($id)
    {
        $product = Product::where('id',$id)->with('category')->first();
        $siteSettings = SiteSetting::latest()->first();
        $allProduct = Product::latest()->get();
        $cart = session('cart', []);
        $auth = auth()->check();
        $authUser = auth()->user();
        $currency = Currency::where('status', 1)->get();
        return inertia('ProductDetails', compact('product','siteSettings','allProduct','cart','auth','authUser','currency'));
    }






}
