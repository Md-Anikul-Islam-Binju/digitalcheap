<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class CommissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('commission-list')) {
                return redirect()->route('unauthorized.action');
            }
            return $next($request);
        })->only('index');
    }

    public function index()
    {
        $users = User::where('is_registration_by', '=', 'Agent')->get();
        $commission = Commission::all();
        return view('admin.pages.commission.index', compact('commission', 'users'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'commission' => 'required',
            ]);
            $commission = new Commission();
            $commission->user_id = $request->user_id;
            $commission->commission = $request->commission;
            $commission->save();
            Toastr::success('Commission Added Successfully', 'Success');
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
                'user_id' => 'required',
                'commission' => 'required',
            ]);
            $commission = Commission::find($id);
            $commission->user_id = $request->user_id;
            $commission->commission = $request->commission;
            $commission->status = $request->status;
            $commission->save();
            Toastr::success('Commission Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $commission = Commission::find($id);
            $commission->delete();
            Toastr::success('Commission Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
