<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\AccountVerificationMail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yoeunes\Toastr\Facades\Toastr;
use function PHPUnit\Framework\isEmpty;

class AccountManageController extends Controller
{
    public function showRegistrationFormForUser()
    {
        return view('auth.registrationFormForUser');
    }

    public function showRegistrationFormForAgent()
    {
        return view('auth.registrationFormForAgent');
    }

    public function storeRegisterInfo(Request $request)
    {

        $referralJoinCode = $request->input('referral_join_code');
        // Validate input
        $this->validate($request, [
            'is_registration_by' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);





        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $verificationCode = rand(100000, 999999);
        $clientIp = $request->header('X-Forwarded-For') ?? $request->ip();
        $randomNumber = rand(100000, 999999);
        $userName = Str::slug($input['name'], '') . $randomNumber;
        try {
            //dd($input);
            // Create user with verification code
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'] ?? null,
                'password' => $input['password'],
                'verification_code' => $verificationCode,
                'status' => 0,



                'is_registration_by' => $input['is_registration_by'],
                'device_ip' => $clientIp,
                'referral_join_code' => $referralJoinCode ?? null,
                'user_name' => $userName ?? null,

            ]);



            // Send verification email
            Mail::to($request->email)->send(new AccountVerificationMail($user));

            Toastr::success('Account created, please verify', 'Success');
            return redirect()->route('account.verification');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return back()->withErrors(['email' => 'The email has already been taken. Please choose a different email.']);
            }
            return back()->withErrors(['email' => 'An error occurred. Please try again later.']);
        }
    }


    public function showVerificationForm()
    {
        return view('auth.registrationVerification');
    }

    public function verify(Request $request)
    {
        $this->validate($request, [
            'verification_code' => 'required',
        ]);

        $user = User::where('verification_code', $request->verification_code)->first();

        if ($user) {
            $user->update([
                'status' => 1,
                'verification_code' => null,
                'email_verified_at' => now(),
            ]);

            // Assign role based on is_registration_by value
            $role = match ($user->is_registration_by) {
                'Agent' => 'Agent',
                'User' => 'User',
            };

            $user->assignRole($role);

            return response()->json(['message' => 'Your account has been verified. You can now login.'], 200);
        } else {
            return response()->json(['message' => 'Invalid verification code.'], 400);
        }
    }




   //My Affiliate code under user
    public function myAffiliateUnderUser()
    {


        $user = User::where('id', auth()->user()->id)->first();
        $myCode = $user->user_name;
        $users = [];
        if($myCode){
            $users = User::where('referral_join_code', $myCode)->get();
        }

        $totalClient = 0;
        if($myCode){
            $totalClient = User::where('referral_join_code', $myCode)->count();
        }
        $user = User::where('id', auth()->user()->id)->with('joinCategory','country')->first();
        return view('admin.pages.account.affiliateUnderUser', compact('users','user','totalClient'));
    }




}
