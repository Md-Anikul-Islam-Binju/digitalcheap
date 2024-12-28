<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class BlogSectionController extends Controller
{
    public function blog()
    {
        $siteSettings = SiteSetting::latest()->first();
        $cart = session('cart', []);
        $blogs = Blog::latest()->get();
        return inertia('Blog',compact('siteSettings','cart','blogs'));
    }


    public function blogDetails($id)
    {
        $siteSettings = SiteSetting::latest()->first();
        $cart = session('cart', []);
        $blog = Blog::where('id',$id)->first();
        return inertia('BlogDetails',compact('siteSettings','cart','blog'));
    }
}
