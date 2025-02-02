<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('partner-list')) {
                return redirect()->route('unauthorized.action');
            }

            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $partner = Partner::all();
        return view('admin.pages.partner.index', compact('partner'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'file' => 'required',
            ]);
            $file = time().'.'.$request->file->extension();
            $request->file->move(public_path('images/partner'), $file);
            $partner = new Partner();
            $partner->name = $request->name;
            $partner->link = $request->link;
            $partner->file = $file;
            $partner->save();
            Toastr::success('Partner Added Successfully', 'Success');
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
                'name' => 'required',
            ]);
            $partner = Partner::find($id);
            $partner->name = $request->name;
            $partner->link = $request->link;
            $partner->status = $request->status;
            if ($request->file) {
                $file = time() . '.' . $request->file->extension();
                $request->file->move(public_path('images/partner'), $file);
                $partner->file = $file;
            }
            $partner->save();
            Toastr::success('Partner Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $partner = Partner::find($id);
            $filePath = public_path('images/partner/' . $partner->file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $partner->delete();
            Toastr::success('Partner Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
