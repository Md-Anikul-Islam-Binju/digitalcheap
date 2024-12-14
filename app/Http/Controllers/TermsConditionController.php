<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class TermsConditionController extends Controller
{
    public function termsAndCondition()
    {
        $siteSettings = SiteSetting::latest()->first();
        $cart = session('cart', []);
        return inertia('TermsAndCondition',compact('siteSettings','cart'));
    }
}
