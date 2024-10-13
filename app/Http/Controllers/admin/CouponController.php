<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Toastr;
class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('coupon-list')) {
                return redirect()->route('unauthorized.action');
            }

            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $coupon = Coupon::latest()->get();
        return view('admin.pages.coupon.index', compact('coupon'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'coupon_code' => 'required',
                'discount_amount' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'use_limit' => 'required',
                'amount_spend' => 'required',
            ]);
            $coupon = new Coupon();
            $coupon->coupon_code = $request->coupon_code;
            $coupon->discount_amount = $request->discount_amount;
            $coupon->start_date = $request->start_date;
            $coupon->end_date = $request->end_date;
            $coupon->use_limit = $request->use_limit;
            $coupon->amount_spend = $request->amount_spend;
            $coupon->save();
            Toastr::success('Coupon Added Successfully', 'Success');
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
                'coupon_code' => 'required',
                'discount_amount' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'use_limit' => 'required',
                'amount_spend' => 'required',
            ]);
            $coupon = Coupon::find($id);
            $coupon->coupon_code = $request->coupon_code;
            $coupon->discount_amount = $request->discount_amount;
            $coupon->start_date = $request->start_date;
            $coupon->end_date = $request->end_date;
            $coupon->use_limit = $request->use_limit;
            $coupon->amount_spend = $request->amount_spend;
            $coupon->save();
            Toastr::success('Coupon Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $coupon = Coupon::find($id);
            $coupon->delete();
            Toastr::success('Coupon Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
