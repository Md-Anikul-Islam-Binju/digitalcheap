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
        $authUser = auth()->user();
        return inertia('Blog',compact('siteSettings','cart','blogs','authUser'));
    }


    public function blogDetails($id)
    {
        $siteSettings = SiteSetting::latest()->first();
        $cart = session('cart', []);
        $blog = Blog::where('id',$id)->first();
        $authUser = auth()->user();
        return inertia('BlogDetails',compact('siteSettings','cart','blog','authUser'));
    }
}
