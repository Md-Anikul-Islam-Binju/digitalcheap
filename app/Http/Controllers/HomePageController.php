<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Package;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Review;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Slider;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomePageController extends Controller
{
    public function frontend()
    {
        $sliders = Slider::where('status',1)->latest()->get();
        $categories = Category::where('status',1)->where('type', 'package')->latest()->get();
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


        $products = Product::latest()->get();
        $services =  Service::where('status',1)->latest()->get();
        $reviews = Review::where('status',1)->latest()->get();
        $siteSettings = SiteSetting::where('id', 1)->first();
        $partner = Partner::where('status',1)->latest()->get();
        $cart = session('cart', []);
        $auth = auth()->check();
        $authUser = auth()->user();

        $bestSellingProducts = OrderItem::select('product_id')
            ->selectRaw('count(product_id) as total')
            ->groupBy('product_id')
            ->orderBy('total','desc')
            ->limit(10)
            ->get();

        $mostSellingProducts = Product::whereIn('id', $bestSellingProducts->pluck('product_id'))
            ->where('status', 1)
            ->latest()
            ->limit(12)
            ->get();
        return inertia('Index',compact('sliders','categories','packages','products',
            'services','reviews','siteSettings','partner','cart','auth','authUser','mostSellingProducts'));
    }


    public function howToUse()
    {
        $siteSettings = SiteSetting::latest()->first();
        $cart = session('cart', []);
        $authUser = auth()->user();
        return inertia('HowToUse',compact('siteSettings','cart','authUser'));
    }

    public function howToAccess()
    {
        $siteSettings = SiteSetting::latest()->first();
        $cart = session('cart', []);
        $authUser = auth()->user();
        return inertia('HowToAccess',compact('siteSettings','cart','authUser'));
    }


    public function howToBecomeAffiliate()
    {
        $siteSettings = SiteSetting::latest()->first();
        $cart = session('cart', []);
        $authUser = auth()->user();
        return inertia('AffiliateJoin',compact('siteSettings','cart','authUser'));
    }


    public function search(Request $request)
    {
        $query = $request->input('q');  // Get the search query from URL
        // Fetch products that match the query
        $products = Product::where('name', 'like', '%' . $query . '%')->latest()->get();
        // Retrieve site settings and other necessary data
        $siteSettings = SiteSetting::where('id', 1)->first();
        $cart = session('cart', []);  // Get cart data
        $auth = auth()->check();  // Check if user is authenticated
        $authUser = auth()->user();  // Get the authenticated user
        return inertia('SearchProduct', compact('siteSettings', 'cart', 'authUser', 'products', 'auth'));
    }

}
