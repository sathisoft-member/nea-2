<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registration;
use App\Exports\RegistrationExport;
use Maatwebsite\Excel\Facades\Excel;
use App\CustomerCategory;
use App\CompleteIdTracker;

class RegistrationBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer_category = CustomerCategory::all();
        $registrations = Registration::where('issue_type', '0')->get();
        return view('admin.registration.list', compact('registrations', 'customer_category'));
    }
    public function freelist()
    {
        $customer_category = CustomerCategory::all();
        $registrations = Registration::where('issue_type', '1')->get();
        return view('admin.registration.freelist', compact('registrations', 'customer_category'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer_category = CustomerCategory::all();
        $darta_number = CompleteIdTracker::find(3);
        return view('admin.registration.add', compact("customer_category", "darta_number"));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'declare_date' => 'required',
            'issue_no' => 'required',
            'applicant_name' => 'required',
            'address' => 'required',
            'customer_category' => 'required'
        ]);
        $registration = new Registration();
        $registration->declare_date            =   $request->declare_date;
        $registration->issue_no                =   $request->issue_no;
        $registration->applicant_name          =   $request->applicant_name;
        $registration->address                 =   $request->address;
        $registration->customer_category       =   $request->customer_category;
        $registration->phone                    =   $request->phone;
        $registration->issue_type              =   $request->issue_type;
        if ($registration->save()) {
            $darta_number = CompleteIdTracker::find(3);
            $darta_number->track_id = $darta_number->track_id + 1;
            $darta_number->save();
            return back()->with('message', 'added successfully');    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer_category = CustomerCategory::all();
        $registration = Registration::find($id);
        return view('admin.registration.show', compact('registration', 'customer_category'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer_category = CustomerCategory::all();
        $registration = Registration::find($id);
        return view('admin.registration.edit', compact('registration', 'customer_category'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'declare_date' => 'required',
            'applicant_name' => 'required',
            'address' => 'required',
            'customer_category' => 'required',
        ]);
        $registration = Registration::find($id);
        $registration->declare_date            =   $request->declare_date;
        $registration->applicant_name          =   $request->applicant_name;
        $registration->address                 =   $request->address;
        $registration->customer_category       =   $request->customer_category;
        $registration->phone                   =   $request->phone;
        $registration->issue_type              =   $request->issue_type;
        $registration->save();
        return back()->with('message', 'update successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function export(Request $request)
    {
        $date = date('y-n-d');
        $name = 'Resgistration-' . $date;
        if ($request->gen_type == 'month') {

            return Excel::download(new RegistrationExport($request->month, NULL, NULL, $request->gen_type, $request->status), $name . '.xlsx');
        } else {
            return Excel::download(new RegistrationExport(NULL, $request->first_date, $request->last_date, $request->gen_type, $request->status), $name . '.xlsx');
        }
    }
    public function getCategoryBy($id)
    {
        $registrations = Registration::where('customer_category', $id)->get();
        return view('admin.registration.table', compact('registrations'));
    }
}
