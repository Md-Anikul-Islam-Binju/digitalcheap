<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermsAndConditionController extends Controller
{
    public function index()
    {
        $termsAndCondition = TermsAndCondition::where('id', 1)->first();
        return view('admin.pages.termsAndCondition.index', compact('termsAndCondition'));
    }

    public function createOrUpdateTermsAndCondition(Request $request, $id = null)
    {
        // Define validation rules
        $rules = [
            'title' => 'nullable|string|max:255',
            'details' => 'nullable|string',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create or update TermsAndCondition instance
        $termsAndCondition = $id ? TermsAndCondition::findOrFail($id) : new TermsAndCondition();

        // Set the fields
        $termsAndCondition->title = $request->input('title');
        $termsAndCondition->details = $request->input('details');

        // Save the instance
        $termsAndCondition->save();

        // Prepare the success message
        $message = $id ? 'Terms and Condition updated successfully!' : 'Terms and Condition created successfully!';

        // Redirect back with a success message
        return redirect()->back()->with('success', $message);
    }

}
