<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use App\Models\News;
use App\Models\Order;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\Showcase;
use App\Models\SiteSetting;
use App\Models\Team;
use App\Models\Training;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Yoeunes\Toastr\Facades\Toastr;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {

        $loginLog = LoginLog::orderBy('last_login','desc')->get();


        $user = User::where('id', auth()->user()->id)->first();
        $myCode = $user->referral_code;
        $totalClient = 0;
        if($myCode){
            $totalClient = User::where('referral_join_code', $myCode)->count();
        }
        $orders = Order::where('user_id', auth()->id())->with('orderItems')->latest()->count();
        $activeOrder = Order::where('user_id', auth()->id())->where('status', 1)->with('orderItems')->latest()->count();
        $inactiveOrder = Order::where('user_id', auth()->id())->where('status', 0)->with('orderItems')->latest()->count();

        $user = User::where('id', auth()->user()->id)->with('joinCategory','country')->first();
        $buyOrder = Order::where('user_id', auth()->user()->id)->count();


        // Start the base query for orders with their orderItems
        $query = Order::where('user_id', auth()->id())
            ->whereHas('orderItems', function ($q) use ($request) {
                $createdAt = $request->input('created_at');
                $date = now(); // current date for comparison

                // Apply filter based on the created_at value in orderItems table
                if ($createdAt) {
                    if ($createdAt == 'today') {
                        $q->whereDate('created_at', $date->toDateString());
                    } elseif ($createdAt == 'week') {
                        $q->whereBetween('created_at', [
                            $date->startOfWeek()->toDateString(),
                            $date->endOfWeek()->toDateString()
                        ]);
                    } elseif ($createdAt == 'month') {
                        $q->whereMonth('created_at', $date->month)
                            ->whereYear('created_at', $date->year);
                    } elseif ($createdAt == 'year') {
                        $q->whereYear('created_at', $date->year);
                    }
                }
            })
            ->with(['orderItems' => function ($q) use ($request) {
                // Apply the same filter on the orderItems relationship
                $createdAt = $request->input('created_at');
                $date = now();

                if ($createdAt) {
                    if ($createdAt == 'today') {
                        $q->whereDate('created_at', $date->toDateString());
                    } elseif ($createdAt == 'week') {
                        $q->whereBetween('created_at', [
                            $date->startOfWeek()->toDateString(),
                            $date->endOfWeek()->toDateString()
                        ]);
                    } elseif ($createdAt == 'month') {
                        $q->whereMonth('created_at', $date->month)
                            ->whereYear('created_at', $date->year);
                    } elseif ($createdAt == 'year') {
                        $q->whereYear('created_at', $date->year);
                    }
                }
            }]);

        // Get the filtered orders
        $ordersItemAll = $query->get();


        if($user->status == 0){
            return view('admin.accountSuspend');
        }else{
            return view('admin.dashboard', compact('loginLog','totalClient','orders','user','buyOrder','activeOrder','inactiveOrder','ordersItemAll'));
        }

    }

    public function unauthorized()
    {
        return view('admin.unauthorized');
    }


    Public function activeUser()
    {
        $activeUser = User::where('is_registration_by','=','User')->where('status',1)->with('orders.orderItems')->get();
        return view('admin.pages.user.activeUser', compact('activeUser'));

    }

    public function changeStatus($id)
    {

        $activeUser = User::where('id', $id)->first();
        if ($activeUser->status == 1) {
            $activeUser->status = 0;
        } else {
            $activeUser->status = 1;
        }
        $activeUser->save();
        return redirect()->back();
    }

    public function manageOrder(Request $request,$id)
    {
        // Start the base query for orders with their orderItems
        $query = Order::where('user_id', $id)
            ->whereHas('orderItems', function ($q) use ($request) {
                $createdAt = $request->input('created_at');
                $date = now(); // current date for comparison

                // Apply filter based on the created_at value in orderItems table
                if ($createdAt) {
                    if ($createdAt == 'today') {
                        $q->whereDate('created_at', $date->toDateString());
                    } elseif ($createdAt == 'week') {
                        $q->whereBetween('created_at', [
                            $date->startOfWeek()->toDateString(),
                            $date->endOfWeek()->toDateString()
                        ]);
                    } elseif ($createdAt == 'month') {
                        $q->whereMonth('created_at', $date->month)
                            ->whereYear('created_at', $date->year);
                    } elseif ($createdAt == 'year') {
                        $q->whereYear('created_at', $date->year);
                    }
                }
            })
            ->with(['orderItems' => function ($q) use ($request) {
                // Apply the same filter on the orderItems relationship
                $createdAt = $request->input('created_at');
                $date = now();

                if ($createdAt) {
                    if ($createdAt == 'today') {
                        $q->whereDate('created_at', $date->toDateString());
                    } elseif ($createdAt == 'week') {
                        $q->whereBetween('created_at', [
                            $date->startOfWeek()->toDateString(),
                            $date->endOfWeek()->toDateString()
                        ]);
                    } elseif ($createdAt == 'month') {
                        $q->whereMonth('created_at', $date->month)
                            ->whereYear('created_at', $date->year);
                    } elseif ($createdAt == 'year') {
                        $q->whereYear('created_at', $date->year);
                    }
                }
            }]);

        // Get the filtered orders
        $orders = $query->get();
        return view('admin.pages.user.orderManage', compact('orders'));
    }

    public function invoiceManage(Request $request,$id)
    {

        $order = Order::where('id', $id)->with('user','orderItems')->first();
        $siteSetting = SiteSetting::first();
        return view('admin.pages.user.invoiceManage', compact('order','siteSetting'));
    }

    public function userInfoUpdate(Request $request, $id)
    {


        try {
            $request->validate([
                'name' => 'required',
            ]);
            $user = User::find($id);
            $user->name = $request->name;
            if($request->password){
                $user->password = $request->password ? Hash::make($request->password) : $user->password;
            }
            $user->save();
            Toastr::success('User Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

        return redirect()->back();
    }





    public function inactiveUser()
    {
        $inactiveUser = User::where('is_registration_by','=','User')->where('status',0)->get();
        return view('admin.pages.user.inactiveUser', compact('inactiveUser'));
    }

    public function editPassword()
    {
        return view('admin.passwordUpdate');
    }

    public function updatePassword(Request $request)
    {

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('status', 'Password updated successfully!');
    }





}
