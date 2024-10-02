<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Toastr;
class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('about-list')) {
                return redirect()->route('unauthorized.action');
            }

            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $about = About::latest()->get();
        return view('admin.pages.about.index', compact('about'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/about'), $imageName);
            $about = new About();
            $about->title = $request->title;
            $about->details = $request->details;
            $about->image = $imageName;
            $about->save();
            Toastr::success('About Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            // Handle the exception here
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required',
            ]);
            $about = About::find($id);
            $about->title = $request->title;
            $about->details = $request->details;
            $about->status = $request->status;
            if($request->image){
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images/about'), $imageName);
                $about->image = $imageName;
            }
            $about->save();
            Toastr::success('About Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $about = About::find($id);
            // Delete associated image from server
            $imagePath = public_path('images/about/' . $about->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            // Delete the Team member
            $about->delete();
            Toastr::success('About Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
