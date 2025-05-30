<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\JoinCategory;
use App\Models\LoginLog;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AccountSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('account-setting')) {
                return redirect()->route('unauthorized.action');
            }

            return $next($request);
        })->only('index');
    }

    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();
        $joinCategory = JoinCategory::latest()->get();
        $countryAll = Country::latest()->get();

        $buyOrder = Order::where('user_id', auth()->user()->id)->count();
        //dd($buyOrder);
        return view('admin.pages.account.index', compact('user', 'joinCategory', 'countryAll', 'buyOrder'));
    }

    public function agent()
    {
        $user = User::where('id', auth()->user()->id)->with('couponCode')->first();
        $countryAll = Country::latest()->get();
        return view('admin.pages.account.agent', compact('user','countryAll'));
    }



    public function createOrUpdateAccount(Request $request, $id = null)
    {


        // Validation rules
        $rules = [
            'name' => 'nullable',
            'email' => 'nullable|email|unique:users,email,' . $id,
            //'phone' => 'nullable|unique:users,phone,' . $id,
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:5120',
            //'address' => 'nullable',
            'join_category_id' => 'nullable',
            'country_id' => 'nullable',
        ];
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //dd($request->all());
        // Find or create user based on provided ID
        $user = $id ? User::findOrFail($id) : new User;
        // Update user fields except for files
        $user->fill($request->except(['profile']));
        // Handle profile image upload
        // Handle profile image upload
        if ($request->hasFile('profile')) {
            // Delete the previous profile image if it exists
            if ($user->profile && File::exists(public_path($user->profile))) {
                File::delete(public_path($user->profile));
            }
            $profileName = time().'.'.$request->file('profile')->extension();
            $request->file('profile')->move(public_path('images/profile'), $profileName);
            $user->profile = 'images/profile/'.$profileName;
        }
        // Save user data
        $user->save();
        $message = $id ? 'Account settings updated successfully!' : 'Account created successfully!';
        return redirect()->back()->with('success', $message);
    }


    public function createOrUpdateAccountAgent(Request $request, $id = null)
    {
        // Validation rules
        $rules = [
            'name' => 'nullable',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'phone' => 'nullable|unique:users,phone,' . $id,
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:5120',
            'address' => 'nullable',
            'country_id' => 'nullable',
        ];
        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Find or create user based on provided ID
        $user = $id ? User::findOrFail($id) : new User;
        // Update user fields except for files
        $user->fill($request->except(['profile']));
        // Handle profile image upload
        // Handle profile image upload
        if ($request->hasFile('profile')) {
            // Delete the previous profile image if it exists
            if ($user->profile && File::exists(public_path($user->profile))) {
                File::delete(public_path($user->profile));
            }
            $profileName = time().'.'.$request->file('profile')->extension();
            $request->file('profile')->move(public_path('images/profile'), $profileName);
            $user->profile = 'images/profile/'.$profileName;
        }
        // Save user data
        $user->save();
        $message = $id ? 'Account settings updated successfully!' : 'Account created successfully!';
        return redirect()->back()->with('success', $message);
    }


    public function activeSubscription(Request $request)
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

        $query = Order::where('user_id', auth()->id())
            ->whereHas('orderItems', function ($q) use ($request) {
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
            })
            ->with(['orderItems' => function ($q) use ($request) {
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
                $q->with('package');
            }]);

        $ordersItemAll = $query->get();

        // Process each order item to add package products
        foreach ($ordersItemAll as $order) {
            foreach ($order->orderItems as $item) {
                if ($item->type == 'package' && $item->package) {
                    // Decode the product_ids from the package
                    $productIds = json_decode($item->package->product_id);

                    if (is_array($productIds)) {
                        // Fetch the products
                        $products = Product::whereIn('id', $productIds)
                            ->select('id', 'name', 'amount','link', 'discount_amount','file')
                            ->get()
                            ->toArray();

                        // Add the products to the package data
                        $item->package->products = $products;
                    } else {
                        $item->package->products = [];
                    }
                }
            }
        }

        if($user->status == 0){
            return view('admin.accountSuspend');
        }

        return view('admin.pages.account.activeSubscription', compact(
            'loginLog',
            'totalClient',
            'orders',
            'user',
            'buyOrder',
            'activeOrder',
            'inactiveOrder',
            'ordersItemAll'
        ));
    }
}
