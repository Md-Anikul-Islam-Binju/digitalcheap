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
        $products = Product::latest()->get();
        $services =  Service::where('status',1)->latest()->get();
        $reviews = Review::where('status',1)->latest()->get();
        $siteSettings = SiteSetting::where('id', 1)->first();
        $partner = Partner::where('status',1)->latest()->get();
        return inertia('Index',compact('sliders','categories','packages','products',
            'services','reviews','siteSettings','partner'));
    }
}
