<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categories = Category::where('status',1)->latest()->get();
        $packages = Package::where('status',1)->with('products')->latest()->get();
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
        $products = Product::latest()->get();
        $services =  Service::where('status',1)->latest()->get();
        $reviews = Review::where('status',1)->latest()->get();
        $siteSettings = SiteSetting::where('id', 1)->first();
        $partner = Partner::where('status',1)->latest()->get();
        $cart = session('cart', []);
        $auth = auth()->check();
        $authUser = auth()->user();

        return inertia('Index',compact('sliders','categories','packages','products',
            'services','reviews','siteSettings','partner','cart','auth','authUser'));
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



//    public function search(Request $request)
//    {
//        $query = $request->input('q');
//        // Get products matching the query (you can adjust the logic to match product names or other fields)
//        $products = Product::where('name', 'like', '%' . $query . '%')->latest()->get();
//
//        // Other data you may need
//        $siteSettings = SiteSetting::where('id', 1)->first();
//        $cart = session('cart', []);
//        $auth = auth()->check();
//        $authUser = auth()->user();
//
//        // Return results to the frontend
//        return inertia('SearchProduct', compact('siteSettings', 'cart', 'authUser', 'products', 'auth'));
//    }

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
        //dd($products);

        // Return data to Inertia with the SearchProduct component
//        return Inertia::render('SearchProduct', [
//            'products' => $products,
//            'siteSettings' => $siteSettings,
//            'cart' => $cart,
//            'authUser' => $authUser,
//            'auth' => $auth,
//        ]);
    }

}
