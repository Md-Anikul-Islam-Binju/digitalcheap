<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

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
        return view('admin.pages.account.index', compact('user'));
    }

    public function createOrUpdateAccount(Request $request, $id = null)
    {
        // Validation rules
        $rules = [
            'name' => 'nullable',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'phone' => 'nullable|unique:users,phone,' . $id,
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:5120',
            'address' => 'nullable',
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
