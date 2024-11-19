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
        try {
            // Validate input data
            $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'package_type' => 'required|string|max:50',
                'package_duration' => 'required|string|max:50',
                'amount' => 'nullable|numeric',
                'discount_amount' => 'nullable|numeric',
                'status' => 'required|boolean',
                'products_json' => 'required|string', // Ensure the JSON field is present and valid
            ]);

            // Decode the JSON field
            $products = json_decode($request->products_json, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Invalid JSON in products_json field");
            }

            // Find the package and update basic details
            $package = Package::findOrFail($id);
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
            $package->products()->delete(); // Clear existing products
            foreach ($products as $productName) {
                if (!empty($productName)) { // Ensure the product name is not empty
                    PackageProduct::create([
                        'package_id' => $package->id,
                        'product' => $productName,
                    ]);
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
