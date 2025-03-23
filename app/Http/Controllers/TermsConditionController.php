<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class TermsConditionController extends Controller
{
    public function termsAndCondition()
    {
        $siteSettings = SiteSetting::latest()->first();
        $cart = session('cart', []);
        $authUser = auth()->user();
        $termsAndCondition = TermsAndCondition::first();
        return inertia('TermsAndCondition',compact('siteSettings','cart','authUser','termsAndCondition'));
    }
}
