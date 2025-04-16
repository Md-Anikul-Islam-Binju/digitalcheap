<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use App\Models\PackageProduct;
use App\Models\Product;
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
        $categories = Category::where('type', 'package')->get();
        $products = Product::latest()->get();
        $package = Package::with('category')->latest()->get();


        foreach ($package as $packageData) {
            $packageInfo = json_decode($packageData->package_type);
            if (is_array($packageInfo)) {
                $selectedPackageTypes = $packageInfo;
                $packageData->package_types = $selectedPackageTypes;
            } else {
                $packageData->package_types = [];
            }
        }

        foreach ($package as $packageInfo) {
            // Decode employee_id
            $productIds = json_decode($packageInfo->product_id);

            if (is_array($productIds)) {
                // Fetch the email and domain_verification_id as an array
                $selectedProduct = Product::whereIn('id', $productIds)
                    ->pluck('name')
                    ->toArray();
                $packageInfo->product = $selectedProduct;
            } else {
                $packageInfo->product = [];
            }
        }
        return view('admin.pages.package.index', compact('package', 'categories', 'products'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'package_type' => 'required',
                'product_id' => 'required',
            ]);
            $package = new Package();
            if ($request->image) {
                $file = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/package'), $file);
                $package->image = $file;
            }
            $package->category_id = $request->category_id;
            $package->name = $request->name;
            $package->package_type = json_encode($request->package_type);
            $package->details = $request->details;
            $package->month_package_amount = $request->month_package_amount;
            $package->month_package_discount_amount = $request->month_package_discount_amount;
            $package->half_year_package_amount = $request->half_year_package_amount;
            $package->half_year_package_discount_amount = $request->half_year_package_discount_amount;
            $package->yearly_package_amount = $request->yearly_package_amount;
            $package->yearly_package_discount_amount = $request->yearly_package_discount_amount;
            $package->product_id = json_encode($request->product_id);
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
            // Validate input data
            $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'status' => 'required|boolean',
            ]);


            // Find the package and update basic details
            $package = Package::findOrFail($id);
            $package->category_id = $request->category_id;
            $package->name = $request->name;
            $package->package_type = json_encode($request->package_type);
            $package->details = $request->details;
            $package->month_package_amount = $request->month_package_amount;
            $package->month_package_discount_amount = $request->month_package_discount_amount;
            $package->half_year_package_amount = $request->half_year_package_amount;
            $package->half_year_package_discount_amount = $request->half_year_package_discount_amount;
            $package->yearly_package_amount = $request->yearly_package_amount;
            $package->yearly_package_discount_amount = $request->yearly_package_discount_amount;
            $package->product_id = json_encode($request->product_id);
            $package->status = $request->status;
            if ($request->image) {
                $file = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/package'), $file);
                $package->image = $file;
            }
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
