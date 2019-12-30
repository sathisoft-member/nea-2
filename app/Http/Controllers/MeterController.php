<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meter;
use App\Customer;
use Response;
use Auth;
use DB;

class MeterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::user()->id;
        $where="add_id=".$id." OR edit_id=".$id." OR return_by=".$id;
        $meter = DB::select("select * from meters where ".$where);
        return view('admin.meter.list',['meters'=>$meter]);
    }

    public function getAll(){
        $meter = Meter::all();
        return view('admin.meter.all',['meters'=>$meter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $meter = Meter::all();
        return view('admin.meter.add',compact('meter'));
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
                'meter_type'=>'required',
                'meter_phase'=>'required',
                'meter_voltage'=>'required|numeric',
                'meter_digit'=>'required|numeric',
                'meter_decimal'=>'required|numeric',
                'mfg_date'=>'required',
                'meter_serial_number'=>'required|unique:meters',
                'meter_manufacture'=>'required',
                'initial_reading'=>'required|numeric',
                'meter_company'=>'required',
                'meter_capacity'=>'required',
                'meter_resulation'=>'required|numeric',
                'meter_type_electro'=>'required',

            ]);
                $meter = new Meter();
                $meter->meter_type = $request->meter_type;
                $meter->meter_phase = $request->meter_phase;
                $meter->meter_voltage = $request->meter_voltage;
                $meter->meter_digit = $request->meter_digit;
                $meter->meter_decimal = $request->meter_decimal;
                $meter->mfg_date = $request->mfg_date;
                $meter->meter_serial_number = $request->meter_serial_number;
                $meter->meter_manufacture = $request->meter_manufacture;
                $meter->initial_reading = $request->initial_reading;
                $meter->meter_company = $request->meter_company;
                $meter->meter_capacity = $request->meter_capacity;
                $meter->meter_resulation = $request->meter_resulation;
                $meter->meter_type_electro = $request->meter_type_electro;
                $meter->add_id = Auth::user()->id;
                $meter->save();
                return Response::json($meter); 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meter=Meter::find($id);
        return view('admin.meter.view',compact('meter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meter = Meter::find($id);
        return view('admin.meter.edit',compact('meter'));
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
        $this->validate($request,[
            'meter_type'=>'required',
            'meter_phase'=>'required',
            'meter_voltage'=>'required|numeric',
            'meter_digit'=>'required|numeric',
            'meter_decimal'=>'required|numeric',
            'mfg_date'=>'required',
            'meter_serial_number'=>'required|unique:meters,meter_serial_number,'.$id.',id',
            'meter_manufacture'=>'required|numeric',
            'initial_reading'=>'required|numeric',
            'meter_company'=>'required',
            'meter_capacity'=>'required',
            'meter_resulation'=>'required|numeric',
            'meter_type_electro'=>'required',

        ]);
        $meter = Meter::find($id);
        $meter->meter_type = $request->meter_type;
        $meter->meter_phase = $request->meter_phase;
        $meter->meter_voltage = $request->meter_voltage;
        $meter->meter_digit = $request->meter_digit;
        $meter->meter_decimal = $request->meter_decimal;
        $meter->mfg_date = $request->mfg_date;
        $meter->meter_serial_number = $request->meter_serial_number;
        $meter->meter_manufacture = $request->meter_manufacture;
        $meter->initial_reading = $request->initial_reading;
        $meter->meter_company = $request->meter_company;
        $meter->meter_capacity = $request->meter_capacity;
        $meter->meter_resulation = $request->meter_resulation;
        $meter->meter_type_electro = $request->meter_type_electro;
        $meter->edit_id = Auth::user()->id;
        $meter->save();
        return Response::json($meter); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meter=Meter::find($id);
        $meter->delete();
        return back();
       
    }

    public function getAvailableMeter(){
         $meter=Meter::where('status',false)->get();
         return view('admin.meter.available',['meters'=>$meter]); 
    }

    public function getAssignedMeter(){
         $meter=Meter::where('status',true)->get();
         return view('admin.meter.assigned',['meters'=>$meter]); 
    }

    public function trash()
    {
        $meters = Meter::onlyTrashed()->get();
         return view('admin.trash.meter',['meters'=>$meters]); 
    }

    public function showTrashed($id){
        $meter = Meter::onlyTrashed()->find($id);
        return view('admin.trash.showmeter',['meter'=>$meter]); 
    }

     public function parmanentRemove($id)
    {
        $meter=Meter::onlyTrashed()->findOrFail($id); ;
        $meter->forceDelete();
        return back();
    }

     public function recoverMeter($id)
    {
        $meter = Meter::onlyTrashed()->findOrFail($id);
        $meter->restore();
        return back();
    }

    public function getReturnMeter(){
        $meter=Meter::where('status',true)->get();
        return view('admin.meter.returnMeter',['meters'=>$meter]);
    }

    public function getMeterAndCustomerDetail($id){
        $meter=Meter::find($id);
        $customer=Customer::where('meter_id',$id)->first();
        return view('admin.meter.customermeterinfo',['meter'=>$meter,'customer'=>$customer]);
        
    }

    public function savereturnedMeter($id){
        $meter=Meter::find($id);
        $customer=Customer::where('meter_id',$id)->first();

        $meter->return_by=Auth::user()->id;
        $meter->return_status=1;
        $meter->status=false;
        $meter->return_date=now();
        $meter->save();

        $customer->status=0;
        $customer->save();
        return back();

    }


}
