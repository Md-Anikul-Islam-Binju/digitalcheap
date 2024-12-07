<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogSectionController extends Controller
{
    public function blog()
    {
        return inertia('Blog');
    }
}
