<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use App\Models\PackageProduct;
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
        $package = Package::with('category','products')->latest()->get();
        $categories = Category::all();
        return view('admin.pages.package.index', compact('package', 'categories'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'package_type' => 'required',
                'package_duration' => 'required',
                'product' => 'required|array', // Ensure products are provided as an array
                'product.*' => 'string|max:255', // Each product name should be a valid string
            ]);
            $package = new Package();
            $package->category_id = $request->category_id;
            $package->name = $request->name;
            $package->package_type = $request->package_type;
            $package->package_duration = $request->package_duration;
            $package->details = $request->details;
            $package->amount = $request->amount;
            $package->discount_amount = $request->discount_amount;
            $package->save();

            // Save the associated products
            foreach ($request->product as $productName) {
                PackageProduct::create([
                    'package_id' => $package->id,
                    'product' => $productName,
                ]);
            }

            Toastr::success('Package Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {

        dd($request->all());
        try {
            $request->validate([
                'name' => 'required',
                'product' => 'nullable|array', // Products can be optional
                'product.*' => 'string|max:255', // Each product must be a valid string
            ]);
            $package = Package::find($id);
            $package->category_id = $request->category_id;
            $package->name = $request->name;
            $package->package_type = $request->package_type;
            $package->package_duration = $request->package_duration;
            $package->details = $request->details;
            $package->amount = $request->amount;
            $package->discount_amount = $request->discount_amount;
            $package->status = $request->status;
            $package->save();

            // Update associated products
            if ($request->has('product')) {
                // Remove existing products and re-add them
                $package->products()->delete();

                foreach ($request->product as $productName) {
                    if (!empty($productName)) { // Ensure the product name is not empty
                        PackageProduct::create([
                            'package_id' => $package->id,
                            'product' => $productName,
                        ]);
                    }
                }
            }


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
