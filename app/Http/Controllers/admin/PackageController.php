<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('package-list')) {
                return redirect()->route('unauthorized.action');
            }

            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $package = Package::latest()->get();
        return view('admin.pages.package.index', compact('package'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'package_type' => 'required',
                'package_duration' => 'required',
            ]);
            $package = new Package();
            $package->name = $request->name;
            $package->package_type = $request->package_type;
            $package->package_duration = $request->package_duration;
            $package->details = $request->details;
            $package->amount = $request->amount;
            $package->discount_amount = $request->discount_amount;
            $package->save();
            Toastr::success('Package Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $request->validate([
                'name' => 'required',
            ]);
            $package = Package::find($id);
            $package->name = $request->name;
            $package->package_type = $request->package_type;
            $package->package_duration = $request->package_duration;
            $package->details = $request->details;
            $package->amount = $request->amount;
            $package->discount_amount = $request->discount_amount;
            $package->status = $request->status;
            $package->save();
            Toastr::success('Package Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $package = Package::find($id);
            $package->delete();
            Toastr::success('Package Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
