<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Package;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function frontend()
    {
        $sliders = Slider::latest()->get();
        $categories = Category::latest()->get();
        $packages = Package::latest()->get();
        return inertia('Index',compact('sliders','categories','packages'));
    }
}
