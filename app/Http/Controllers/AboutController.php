<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        $siteSettings = SiteSetting::latest()->first();
        $cart = session('cart', []);
        return inertia('About',compact('siteSettings','cart'));
    }
}
