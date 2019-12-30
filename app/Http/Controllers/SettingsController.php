<?php

namespace App\Http\Controllers;

use App\cr;
use App\Customer;
use Illuminate\Http\Request;
use App\User;
use App\EmailTemplate;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }

    public function getEmailTemplate()
    {
        return view('admin.settings.email');
    }

    public function postEmailTemplate(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required',
            'contact' => 'required'
        ]);

        $email = new EmailTemplate();
        $email->subject = $request->subject;
        $email->message = $request->message;
        $email->contact = $request->contact;
        $email->save();
        return back()->with("message", "Added");
    }

    public function updateEmailTemplate(Request $request, $id)
    {
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required',
            'contact' => 'required'
        ]);
        $email = EmailTemplate::find($id);
        $email->subject = $request->subject;
        $email->message = $request->message;
        $email->contact = $request->contact;
        $email->save();
        return back()->with("message", "Updated");
    }

    public function test()
    {

        $customers = Customer::all();
        $date = date('Y-m-d');
        return view('pdf1', ['customers' => $customers, 'date' => "2019-12-3", 'vauchar_number' => 201]);
    }
}
