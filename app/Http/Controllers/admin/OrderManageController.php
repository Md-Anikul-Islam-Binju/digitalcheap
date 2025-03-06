<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\SiteSetting;
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

    public function index(Request $request)
    {
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
        $orders = $query->get();
        return view('admin.pages.order.index', compact('orders'));
    }


    public function orderActive()
    {
        $orders = Order::where('user_id', auth()->id())
            ->whereHas('orderItems', function ($q) {
                $q->where(function ($q) {
                    // For type 'product' with duration in months as integer
                    $q->where('type', 'product')
                        ->whereRaw('DATE_ADD(created_at, INTERVAL duration MONTH) >= CURDATE()');
                })
                    ->orWhere(function ($q) {
                        // For type 'package' with specific duration text
                        $q->where('type', 'package')
                            ->where(function ($q) {
                                $q->where('duration', 'Monthly')
                                    ->whereRaw('DATE_ADD(created_at, INTERVAL 1 MONTH) >= CURDATE()');
                            })
                            ->orWhere(function ($q) {
                                $q->where('duration', 'Half Yearly')
                                    ->whereRaw('DATE_ADD(created_at, INTERVAL 6 MONTH) >= CURDATE()');
                            })
                            ->orWhere(function ($q) {
                                $q->where('duration', 'Yearly')
                                    ->whereRaw('DATE_ADD(created_at, INTERVAL 12 MONTH) >= CURDATE()');
                            });
                    });
            })
            ->with(['orderItems' => function ($q) {
                $q->where(function ($q) {
                    // For product: Check if within duration months
                    $q->where('type', 'product')
                        ->whereRaw('DATE_ADD(created_at, INTERVAL duration MONTH) >= CURDATE()');
                })
                    ->orWhere(function ($q) {
                        // For package: Check if within the correct period
                        $q->where('type', 'package')
                            ->where(function ($q) {
                                $q->where('duration', 'Monthly')
                                    ->whereRaw('DATE_ADD(created_at, INTERVAL 1 MONTH) >= CURDATE()');
                            })
                            ->orWhere(function ($q) {
                                $q->where('duration', 'Half Yearly')
                                    ->whereRaw('DATE_ADD(created_at, INTERVAL 6 MONTH) >= CURDATE()');
                            })
                            ->orWhere(function ($q) {
                                $q->where('duration', 'Yearly')
                                    ->whereRaw('DATE_ADD(created_at, INTERVAL 12 MONTH) >= CURDATE()');
                            });
                    });
            }])
            ->latest()
            ->get();

        return view('admin.pages.order.activeOrder', compact('orders'));
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


    public function invoice(Request $request,$id)
    {

        $order = Order::where('id', $id)->with('orderItems')->first();
        $user = auth()->user();
        $siteSetting = SiteSetting::first();
        return view('admin.pages.order.invoice', compact('order','user','siteSetting'));
    }



}
