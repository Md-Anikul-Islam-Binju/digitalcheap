<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('product-list')) {
                return redirect()->route('unauthorized.action');
            }

            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $product = Product::all();
        $categories = Category::all();
        return view('admin.pages.product.index', compact('product','categories'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'file' => 'required',
            ]);
            $file = time().'.'.$request->file->extension();
            $request->file->move(public_path('images/product'), $file);
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->details = $request->details;
            $product->link = $request->link;
            $product->additional_information = $request->additional_information;
            $product->amount = $request->amount;
            $product->discount_amount = $request->discount_amount;
            $product->file = $file;
            $product->save();
            Toastr::success('Product Added Successfully', 'Success');
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
            $product = Product::find($id);
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->details = $request->details;
            $product->link = $request->link;
            $product->additional_information = $request->additional_information;
            $product->amount = $request->amount;
            $product->discount_amount = $request->discount_amount;
            $product->status = $request->status;
            if ($request->file) {
                $file = time() . '.' . $request->file->extension();
                $request->file->move(public_path('images/product'), $file);
                $product->file = $file;
            }
            $product->save();
            Toastr::success('Product Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            $filePath = public_path('images/product/' . $product->file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $product->delete();
            Toastr::success('Product Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
