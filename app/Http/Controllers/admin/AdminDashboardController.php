<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Package;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use App\Models\UserEmailSendReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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

        return view('admin.dashboard', compact(
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

    public function unauthorized()
    {
        return view('admin.unauthorized');
    }


    Public function activeUser()
    {
        $activeUser = User::where('is_registration_by','=','User')->where('status',1)->with('orders.orderItems')->get();
        $product = Product::where('status',1)->get();
        $package = Package::where('status',1)->get();
        return view('admin.pages.user.activeUser', compact('activeUser','product','package'));

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
    }

    public function userAssignTools(Request $request, $id)
    {
        $order = Order::create([
            'invoice_no' => 'INV-' . strtoupper(Str::random(8)),
            'user_id' => $id,
            'payment_method' => 'cash',
            'total' => 0,
            'status' => 'pending',
        ]);

        $total = 0;

        // Product Assignment
        if ($request->product_id) {
            $product = Product::find($request->product_id);
            $price = $product?->amount ?? 0;
            $discount = $product?->discount_amount ?? 0;
            $finalPrice = max($price - $discount, 0);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'package_id' => null,
                'name' => $product->name,
                'duration' => $request->duration_product,
                'device_access' => $request->device_access,
                'is_free_or_paid' => 'paid',
                'price' => $finalPrice,
                'type' => 'product',
            ]);

            $total += $finalPrice;

            // Package Assignment
        } elseif ($request->package_id) {
            $package = Package::find($request->package_id);
            $duration = $request->duration_package;
            $price = 0;

            switch ($duration) {
                case 'Monthly':
                    $price = max(($package->month_package_amount ?? 0) - ($package->month_package_discount_amount ?? 0), 0);
                    break;
                case 'Half Yearly':
                    $price = max(($package->half_year_package_amount ?? 0) - ($package->half_year_package_discount_amount ?? 0), 0);
                    break;
                case 'Yearly':
                    $price = max(($package->yearly_package_amount ?? 0) - ($package->yearly_package_discount_amount ?? 0), 0);
                    break;
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => null,
                'package_id' => $package->id,
                'name' => $package->name,
                'duration' => $duration,
                'device_access' => $request->device_access,
                'is_free_or_paid' => 'buy',
                'price' => $price,
                'type' => 'package',
            ]);

            $total += $price;
        }

        // Update Order Total
        $order->update([
            'total' => $total,
        ]);
        Toastr::success('Tools assigned successfully', 'Success');
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


    public function sendEmail(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Save email send report
        UserEmailSendReport::create([
            'user_id' => $id,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Send Email
        Mail::raw($request->message, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Message from Digitalcheap');
        });

        return redirect()->back()->with('success', 'Email sent successfully!');
    }





}
