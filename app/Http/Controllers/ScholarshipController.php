<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
class ScholarshipController extends Controller
{
    public function create()
    {
        return view('scholarship');
    }

    public function saveData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'scholarshipType' => 'required',
            'newOrReEntry' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'emailAddress' => 'required|email',
            'phoneNumber' => 'required',
            'streetAddress' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'programInterest' => 'required',
            'admissionsAdvisor' => 'required',
            'agreeSignature' => 'required|in:1',
            'signatureTextInput' => 'required',
            'dateSigned' => 'required|date',
        ], $messages = [
                'scholarshipType.required' => 'Please select a scholarship type.',
                'newOrReEntry.required' => 'Please indicate if you are a new or re-entry student.',
                'firstName.required' => 'First name is required.',
                'lastName.required' => 'Last name is required.',
                'emailAddress.required' => 'Email address is required.',
                'emailAddress.email' => 'Please enter a valid email address.',
                'phoneNumber.required' => 'Phone number is required.',
                'streetAddress.required' => 'Street address is required.',
                'city.required' => 'City is required.',
                'state.required' => 'State is required.',
                'zip.required' => 'ZIP code is required.',
                'programInterest.required' => 'Please select your program of interest.',
                'admissionsAdvisor.required' => 'Please enter your admissions advisor\'s name.',
                'agreeSignature.required' => 'You must agree and sign the scholarship form.',
                'agreeSignature.in' => 'Invalid agreement for signature. Please check the box.',
                'signatureTextInput.required' => 'Signature is required.',
                'dateSigned.required' => 'Date signed is required.',
                'dateSigned.date' => 'Date signed must be a valid date.',
            ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            Scholarship::create($request->only([
                'scholarshipType',
                'newOrReEntry',
                'firstName',
                'lastName',
                'emailAddress',
                'phoneNumber',
                'streetAddress',
                'city',
                'state',
                'zip',
                'programInterest',
                'admissionsAdvisor',
                'agreeSignature',
                'agreeSMS',
                'signatureTextInput',
                'dateSigned',
            ]));
            return redirect('/')->with('success', 'Thank you!');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->back()->withErrors(['emailAddress' => 'This email has already been used to apply.']);
            }
            return redirect()->back()->withErrors(['general' => 'Something went wrong. Please try again.']);
        }
    }

}
