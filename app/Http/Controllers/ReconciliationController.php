<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reconciliation;

use App\Exports\GoneMeterExcelExport;
use App\Exports\StoreMeterExcelExport;
use Maatwebsite\Excel\Facades\Excel;

class ReconciliationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $reconciliation1 = Reconciliation::where('type','1')->get();
       $reconciliation2 = Reconciliation::where('type','0')->get();
       return view('admin.reconciliation.index',compact('reconciliation1','reconciliation2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'date'=>'required',
            'quantity'=>'required'
        ]);

        if($request->type==0 || $request->type==1 ){
        $reconciliation = new Reconciliation();
        $reconciliation->date            =      $request->date;
        $reconciliation->quantity        =      $request->quantity;
        $reconciliation->type            =      $request->type;
        $reconciliation->save();
            return back()->with('message','added successfully');            
        }
        return back()->with('message','Sorry Not Added This Value');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Reconciliation::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $reconciliation=Reconciliation::find($request->id);
        $reconciliation->date=$request->date;
        $reconciliation->quantity=$request->quantity;
        if($reconciliation->save()){
            return back()->with('message','Updated successfully');
        }
        return back()->with('message','Sorry Not Updated This Value');


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

    public function meter_got_report(){
        $date = date('y-n-d');
        $name = 'got_report-' . $date;
        return Excel::download(new StoreMeterExcelExport(), $name . '.xlsx');
    }

    public function meter_expenditure_report(){
        $date = date('y-n-d');
        $name = 'expenditure_report-' . $date;
        return Excel::download(new GoneMeterExcelExport(), $name . '.xlsx');
    }
}
