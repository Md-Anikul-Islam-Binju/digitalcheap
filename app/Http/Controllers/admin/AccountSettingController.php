<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\JoinCategory;
use App\Models\Order;
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
        $user = User::where('id', auth()->user()->id)->first();
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
}
