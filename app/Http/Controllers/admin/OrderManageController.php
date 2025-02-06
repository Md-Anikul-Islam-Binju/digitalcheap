<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderManageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('order-list')) {
                return redirect()->route('unauthorized.action');
            }

            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->with('orderItems')->latest()->get();
        return view('admin.pages.order.index', compact('orders'));
    }

    public function userManageByAdmin()
    {
        $users = User::where('is_registration_by','=','User')->latest()->get();
        return view('admin.pages.order.userList', compact('users'));
    }
    public function orderManageByAdmin($id)
    {
        $orders = Order::where('user_id', $id)->with('orderItems')->latest()->get();
        return view('admin.pages.order.orderManage', compact('orders'));
    }


}
