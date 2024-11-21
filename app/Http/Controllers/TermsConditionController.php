<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsConditionController extends Controller
{
    public function termsAndCondition()
    {
        return inertia('TermsAndCondition');
    }
}
