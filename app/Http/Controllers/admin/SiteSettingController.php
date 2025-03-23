<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class SiteSettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('site-setting')) {
                return redirect()->route('unauthorized.action');
            }
            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $siteSettings = SiteSetting::where('id', 1)->first();
        return view('admin.pages.siteSetting.siteSetting', compact('siteSettings'));
    }

    public function createOrUpdate(Request $request, $id = null)
    {

        // Validation rules
        $rules = [
            'name' => 'nullable',
            'title' => 'nullable',
            'meta_description' => 'nullable',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:5120', // Adjust max file size as needed
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:5120', // Adjust max file size as needed
            'site_preview_image' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:5120', // Adjust max file size as needed
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'short_description' => 'nullable',
            'site_link' => 'nullable',
            'facebook_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',

            'how_to_use' => 'nullable',
            'how_to_use_link' => 'nullable',
            'how_to_access' => 'nullable',
            'how_to_access_link' => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($id) {
            $setting = SiteSetting::findOrFail($id);
            $setting->update($request->except(['favicon', 'logo', 'site_preview_image']));
        } else {
            $setting = new SiteSetting($request->except(['favicon', 'logo', 'site_preview_image']));
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $faviconName = time().'.'.$request->file('favicon')->extension();
            $request->file('favicon')->move(public_path('images/favicons'), $faviconName);
            $setting->favicon = 'images/favicons/'.$faviconName;
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoName = time().'.'.$request->file('logo')->extension();
            $request->file('logo')->move(public_path('images/logos'), $logoName);
            $setting->logo = 'images/logos/'.$logoName;
        }
        // Handle logo upload
        if ($request->hasFile('site_preview_image')) {
            $previewName = time().'.'.$request->file('site_preview_image')->extension();
            $request->file('site_preview_image')->move(public_path('images/site_preview_image'), $previewName);
            $setting->site_preview_image = 'images/site_preview_image/'.$previewName;
        }
        $setting->save();
        $message = $id ? 'Site settings updated successfully!' : 'Site settings created successfully!';
        return redirect()->back()->with('success', $message);
    }

}
