<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('report-list')) {
                return redirect()->route('unauthorized.action');
            }
            return $next($request);
        })->only('index');
    }

    public function index(Request $request)
    {
        //$query = Order::with('orderItems');
        $query = Order::with(['orderItems', 'coupon']);
        // Date range filters (optional)
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        } elseif ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        } elseif ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        // Order type filter (optional)
        if ($request->filled('type')) {
            $query->whereHas('orderItems', function ($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        $report = $query->get();



        $totalOrderProduct = OrderItem::where('type', '=', 'product')->count();
        $totalOrderPackage = OrderItem::where('type', '=', 'package')->count();

        //every Month wise order
        $january = Order::whereMonth('created_at', 1)->count();
        $february = Order::whereMonth('created_at', 2)->count();
        $march = Order::whereMonth('created_at', 3)->count();
        $april = Order::whereMonth('created_at', 4)->count();
        $may = Order::whereMonth('created_at', 5)->count();
        $june = Order::whereMonth('created_at', 6)->count();
        $july = Order::whereMonth('created_at', 7)->count();
        $august = Order::whereMonth('created_at', 8)->count();
        $september = Order::whereMonth('created_at', 9)->count();
        $october = Order::whereMonth('created_at', 10)->count();
        $november = Order::whereMonth('created_at', 11)->count();
        $december = Order::whereMonth('created_at', 12)->count();
        $monthlyOrders = [
            'January' => $january,
            'February' => $february,
            'March' => $march,
            'April' => $april,
            'May' => $may,
            'June' => $june,
            'July' => $july,
            'August' => $august,
            'September' => $september,
            'October' => $october,
            'November' => $november,
            'December' => $december,
        ];

        $siteOrders = Order::where('coupon_code' , null)->count();
        $agentOrders = Order::whereNotNull('coupon_code')->count();

        return view('admin.pages.report.index', compact('report','totalOrderProduct', 'totalOrderPackage',
            'monthlyOrders','siteOrders', 'agentOrders'));
    }
}
