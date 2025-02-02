<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yoeunes\Toastr\Facades\Toastr;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('service-list')) {
                return redirect()->route('unauthorized.action');
            }

            return $next($request);
        })->only('index');
    }
    public function index()
    {
        $service = Service::all();
        return view('admin.pages.service.index', compact('service'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'file' => 'required',
            ]);
            $file = time().'.'.$request->file->extension();
            $request->file->move(public_path('images/service'), $file);
            $service = new Service();
            $service->name = $request->name;
            $service->details = $request->details;
            $service->file = $file;
            $service->save();
            Toastr::success('Service Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $request->validate([
                'name' => 'required',
            ]);
            $service = Service::find($id);
            $service->name = $request->name;
            $service->details = $request->details;
            $service->status = $request->status;
            if ($request->file) {
                $file = time() . '.' . $request->file->extension();
                $request->file->move(public_path('images/service'), $file);
                $service->file = $file;
            }
            $service->save();
            Toastr::success('Service Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $service = Service::find($id);
            $filePath = public_path('images/service/' . $service->file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $service->delete();
            Toastr::success('Service Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
