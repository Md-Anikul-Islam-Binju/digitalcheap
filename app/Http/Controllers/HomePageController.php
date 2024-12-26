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
        return inertia('Index',compact('sliders','categories','packages','products',
            'services','reviews','siteSettings','partner','cart','auth'));
    }
}
