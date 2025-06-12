<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
class ScholarshipController extends Controller
{
    public function create()
    {
        $scholarshipOptions = [
            '100000021' => 'Associate Graduation Scholarship',
            '100000000' => 'Academic Achievement & Early Placement Scholarship',
            '100000001' => 'Amazon Employee Career Transition Scholarship',
            '100000002' => "Bachelor's Scholarship",
            '100000020' => 'Certificate Graduation Scholarship',
            '100000003' => 'CIAT Graduate Scholarship',
            '100000004' => 'College of the Sequoias Transfer Scholarship',
            '100000005' => 'College Prep Scholarship',
            '100000006' => 'Delete the Divide Community Scholarship',
            '100000007' => 'Frontline Heroes Scholarship',
            '100000008' => 'Industry Scholarship',
            '100000009' => 'Merced College Transfer Scholarship',
            '100000010' => 'NAF Community Scholarship',
            '100000011' => 'Pell Grant Match Scholarship',
            '100000012' => 'Presidential Scholarship',
            '100000013' => 'San Diego Community College District Transfer Scholarship',
            '100000014' => 'San Diego Regional Chamber of Commerce Community Scholarship',
            '100000015' => 'Starbucks Employee Career Transition Scholarship',
            '100000016' => 'Target Employee Career Transition Scholarship',
            '100000017' => 'Transfer Scholarship',
            '100000018' => 'Walmart Employee Career Transition Scholarship',
            '100000019' => 'Women in Technology Scholarship',
        ];

        $stateOptions = [
            '100000000' => 'Alabama',
            '100000001' => 'Alaska',
            '100000002' => 'Arizona',
            '100000003' => 'Arkansas',
            '100000004' => 'California',
            '100000005' => 'Colorado',
            '100000006' => 'Connecticut',
            '100000007' => 'Delaware',
            '100000050' => 'District of Columbia',
            '100000008' => 'Florida',
            '100000009' => 'Georgia',
            '100000010' => 'Hawaii',
            '100000011' => 'Idaho',
            '100000012' => 'Illinois',
            '100000013' => 'Indiana',
            '100000014' => 'Iowa',
            '100000015' => 'Kansas',
            '100000016' => 'Kentucky',
            '100000017' => 'Louisiana',
            '100000018' => 'Maine',
            '100000019' => 'Maryland',
            '100000020' => 'Massachusetts',
            '100000021' => 'Michigan',
            '100000022' => 'Minnesota',
            '100000023' => 'Mississippi',
            '100000024' => 'Missouri',
            '100000025' => 'Montana',
            '100000026' => 'Nebraska',
            '100000027' => 'Nevada',
            '100000028' => 'New Hampshire',
            '100000029' => 'New Jersey',
            '100000030' => 'New Mexico',
            '100000031' => 'New York',
            '100000032' => 'North Carolina',
            '100000033' => 'North Dakota',
            '100000034' => 'Ohio',
            '100000035' => 'Oklahoma',
            '100000036' => 'Oregon',
            '100000037' => 'Pennsylvania',
            '100000038' => 'Rhode Island',
            '100000039' => 'South Carolina',
            '100000040' => 'South Dakota',
            '100000041' => 'Tennessee',
            '100000042' => 'Texas',
            '100000043' => 'Utah',
            '100000044' => 'Vermont',
            '100000045' => 'Virginia',
            '100000046' => 'Washington',
            '100000051' => 'Washington, D.C.',
            '100000047' => 'West Virginia',
            '100000048' => 'Wisconsin',
            '100000049' => 'Wyoming',
        ];

        $programOptions = [
            '100000013' => 'AI/ML',
            '100000018' => 'Business Administration',
            '100000011' => 'Cloud Administration',
            '100000002' => 'Cybersecurity',
            '100000021' => 'Digital Marketing',
            '100000019' => 'Healthcare Management',
            '100000020' => 'Human Resources',
            '100000005' => 'Information Technology',
            '100000000' => 'Networking',
            '100000017' => 'Project Management',
            '100000001' => 'Software Development',
            '100000015' => 'Web Development',
            '100000016' => 'Mobile App Development',
            '100000014' => 'Data Analytics',
        ];

        $advisorOptions = [
            '100000000' => "I don't know/haven't been assigned one yet",
            '100000001' => 'Aaron Moreno',
            '303950003' => 'Avery Gibson',
            '100000004' => 'Alan Gardner',
            '303950001' => 'Amber Ferguson',
            '303950002' => 'Ashley Salido',
            '303950021' => 'Becca Thomason',
            '303950004' => 'Bianca Singer',
            '303950005' => 'Brooke Finney',
            '303950030' => 'Celina St Clair',
            '100000007' => 'Darrell Terry',
            '303950007' => 'Douglas Webb',
            '303950009' => 'Elizabeth Vasquez',
            '303950031' => 'Esther Edwards',
            '100000008' => 'Freddy Vargas',
            '100000006' => 'Grant Smith',
            '303950010' => 'Jerrell Powell',
            '303950011' => 'Joseph Hancock',
            '303950032' => 'Kat Maner',
            '303950012' => 'Katherine Lerma',
            '303950013' => 'Leslie Ochoa',
            '100000005' => 'Leonardo Cardenas',
            '303950014' => 'Mandy Manus',
            '303950016' => 'Max Rivas',
            '303950029' => 'Michael Morris',
            '303950017' => 'Michel Torres',
            '303950018' => 'Monica Herrera',
            '100000002' => 'Nancy Nguyen',
            '100000003' => 'Natalie Perkins',
            '303950019' => 'Noah Sturdevant',
            '100000009' => 'OnTay Johnson',
            '303950020' => 'Rachel Thiel',
            '303950022' => 'Rhea Ancheta',
            '303950023' => 'Ryan Larson',
            '303950024' => 'Sasha Dillon',
            '303950025' => 'Shelsey Emeish',
            '303950026' => 'Terrance Taylor',
            '303950027' => 'Tony Gana',
        ];

        return view('scholarship', compact('scholarshipOptions', 'stateOptions', 'programOptions', 'advisorOptions'));
    }

    public function saveData(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
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
            ],
            $messages = [
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
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            Scholarship::create(
                $request->only([
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
                ])
            );
            return redirect('/')->with('success', 'Thank you!');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()
                    ->back()
                    ->withErrors(['emailAddress' => 'This email has already been used to apply.']);
            }
            return redirect()
                ->back()
                ->withErrors(['general' => 'Something went wrong. Please try again.']);
        }
    }
}
