<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function frontend()
    {
        $sliders = Slider::latest()->get();
        return inertia('Index',compact('sliders'));
    }
}
