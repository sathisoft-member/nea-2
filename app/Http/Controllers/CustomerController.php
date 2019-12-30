<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Meter;
use App\CompleteIdTracker;
use App\EmailTemplate;
use App\Vaucher;
use PDF;
use App;
use Storage;
use File;
use Auth;
use \App\Mail\SendMail;
use App\Receiver;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::where(['status' => 0, 'user_id' => Auth::user()->id])->get();
        return view('admin.customer.pending', ['customers' => $customer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $receivers = Receiver::all();
        return view('admin.customer.add', compact('receivers'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $customer = DB::table('customers')->where('name', 'like', '%' . $search . '%')->get();
        return view('admin.customer.list', ['customers' => $customer]);
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
            'name' => 'required',
            'address' => 'required',
            'submitted' => 'required',
            'phone' => 'required |numeric',
        ]);
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->submitted = $request->submitted;
        $customer->phone = $request->phone;
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_email = $request->customer_email;
        $customer->completed_id = 0;
        $customer->add_id = Auth::user()->id;



        if ($customer->save()) {
            return response()->json(['success' => true]);
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
        $customer = Customer::find($id);
        return view('admin.customer.edit', compact("customer"));
    }

    public function editremarks($id)
    {
        return $customer = Customer::find($id);
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
            'name' => 'required',
            'address' => 'required',
            'submitted' => 'required',
            'phone' => 'required |numeric',
        ]);
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->submitted = $request->submitted;
        $customer->phone = $request->phone;
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_email = $request->customer_email;
        $customer->edit_id = Auth::user()->id;
        $customer->save();
        return back()->with("message", "Successfully Updated");
    }
    public function return_remarks_update(Request $request)
    {
        $this->validate($request, [
            'return_remarks' => 'required',
        ]);
        $customer = Customer::find($request->id);
        $customer->return_remarks = $request->return_remarks;
        $customer->edit_id = Auth::user()->id;
        $customer->save();
        return back()->with("message", "Successfully Updated");
    }

    public function reject_remarks_update(Request $request)
    {
        $this->validate($request, [
            'reject_remarks' => 'required',
        ]);
        $customer = Customer::find($request->id);
        $customer->reject_remarks = $request->reject_remarks;
        $customer->edit_id = Auth::user()->id;
        $customer->save();
        return back()->with("message", "Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return back();
    }


    public function pendingCustomer()
    {
        $customer = Customer::where('status', 0)->get();
        return view('admin.customer.pending', ['customers' => $customer]);
    }

    public function returnCustomer()
    {
        $customer = Customer::where('status', 3)->get();
        return view('admin.customer.return', ['customers' => $customer]);
    }

    public function doneCustomer()
    {
        $customer = Customer::where('status', 4)->get();
        return view('admin.customer.done', ['customers' => $customer]);
    }

    public function completedCustomer()
    {
        $customer = Customer::orderBy('completed_id', 'asc')->where('status', 1)->get();
        return view('admin.customer.completed', ['customers' => $customer]);
    }

    public function rejetedCustomer()
    {
        $customer = Customer::where('status', 2)->get();
        return view('admin.customer.rejected', ['customers' => $customer]);
    }

    public function rejected($id)
    {
        DB::table('customers')
            ->where("id", '=', $id)
            ->update(['status' => 2, 'rejected_id' => Auth::user()->id]);
        return  response()->json(['success' => true]);
    }
    public function done($id)
    {
        DB::table('customers')
            ->where("id", '=', $id)
            ->update(['status' => 4, 'done_id' => Auth::user()->id]);
        return  response()->json(['success' => true]);
    }

    public function pending($id)
    {
        DB::table('customers')
            ->where("id", '=', $id)
            ->update(['status' => 0]);
        return  response()->json(['success' => true]);
    }

    public function getCompleted($id)
    {
        $customer = Customer::find($id);
        $meters = Meter::where('status', 0)->get();
        return view('admin.customer.completeform', ['customer' => $customer, 'meters' => $meters]);
    }

    public function getReturned($id)
    {
        $customer = Customer::find($id);
        return view('admin.customer.returnform', ['customer' => $customer]);
    }

    public function getRejected($id)
    {
        $customer = Customer::find($id);
        return view('admin.customer.rejectform', ['customer' => $customer]);
    }

    public function postCompleted(Request $request, $id)
    {
        $tracker = CompleteIdTracker::find(1);
        $track_id = $tracker->track_id;

        $customer = Customer::find($id);
        $customer->completed_id = $track_id;
        $customer->completed_by = Auth::user()->id;
        $customer->status = 1;
        $customer->meter_id = $request->meter_id;
        $customer->take_date = $request->take_date;
        $customer->customer_id = ($request->customer_id) ? $request->customer_id : 0;
        if ($customer->save()) {
            //update Tracker Table
            $tracker->track_id = $track_id + 1;
            $tracker->save();
            //meter status
            $meter = Meter::find($request->meter_id);
            $meter->status = 1;
            $meter->save();
            return response()->json(['success' => true]);
        }
    }
    public function postReturned(Request $request, $id)
    {
        $this->validate($request, [
            'return_remarks' => 'required'
        ]);
        $tracker = CompleteIdTracker::find(4);
        $track_id = $tracker->track_id;

        $customer = Customer::find($id);
        $customer->return_id = $track_id;
        $customer->return_by = Auth::user()->id;
        $customer->status = 3;
        $customer->return_remarks = $request->return_remarks;
        if ($customer->save()) {
            //update Tracker Table
            $tracker->track_id = $track_id + 1;
            $tracker->save();
            return response()->json(['success' => true]);
        }
    }
    public function postRejected(Request $request, $id)
    {
        $this->validate($request, [
            'reject_remarks' => 'required'
        ]);
        $tracker = CompleteIdTracker::find(5);
        $track_id = $tracker->track_id;

        $customer = Customer::find($id);
        $customer->reject_track_id = $track_id;
        $customer->rejected_id = Auth::user()->id;
        $customer->status = 2;
        $customer->reject_remarks = $request->reject_remarks;
        if ($customer->save()) {
            //update Tracker Table
            $tracker->track_id = $track_id + 1;
            $tracker->save();
            return response()->json(['success' => true]);
        }
    }

    public function getMeterDetail($id)
    {
        $meter = Meter::find($id);
        return view('admin.customer.meterDetail', ['meter' => $meter]);
    }

    public function view($id)
    {
        $customer = Customer::find($id);
        $meter = Meter::where('id', $customer->meter_id)->first();
        return view('admin.customer.view', ['customer' => $customer, 'meter' => $meter]);
    }
    public function pdf()
    {
        $customers = Customer::where('status', 1)->limit(20)->get();
        return view('pdf', ['customers' => $customers, 'date' => '2076-12-11']);
    }

    public function generatepdf(Request $request)
    {
        $customers = DB::select('select * from customers where status=1 AND vauchar_status=false order by customer_id =0,customer_id ASC limit 25 ');
        //dd($customers);
        if ($customers) {
            $vaucher = CompleteIdTracker::find(2);
            $pdf = PDF::loadView('pdf', ['customers' => $customers, 'date' => $request->rm, 'vauchar_number' => $vaucher->track_id])->setPaper('a4', 'landscape');
            Storage::put('public/pdf/' . $request->rm . '_' . $vaucher->track_id . '.pdf', $pdf->output());
            $filename = $request->rm . '_' . $vaucher->track_id . '.pdf';

            $storevaucher = new Vaucher();
            $storevaucher->file_name = $filename;
            $storevaucher->gen_date = $request->rm;
            $storevaucher->user_id = Auth::user()->id;
            $storevaucher->vaucher_id = $vaucher->track_id;

            if ($storevaucher->save()) {
                foreach ($customers as $customer) {
                    $cus = Customer::find($customer->id);
                    $cus->vauchar_status = true;
                    $cus->vauchar_number = $vaucher->track_id;
                    $cus->save();
                }
                $vaucher->track_id = $vaucher->track_id + 1;
                $vaucher->save();
            }
            return $pdf->download($request->rm . '.pdf');
        }
        return back()->with('message', "Sorry Customer is not available");
    }


    public function selectedCustomerpdf(Request $request)
    {
        $customer_ids = explode(',', $request->checkbox_id);
        $where = "id";
        $where_store = "";
        foreach ($customer_ids as $key => $value) {
            $where_store = $where_store . $where . "=" . $value . " OR ";
        }

        $where = rtrim($where_store, ' OR ');
        $where = $where." order by customer_id =0,customer_id ASC";
        $customers = DB::select("select * from customers where " . $where);


        $vaucher = CompleteIdTracker::find(2);
        $view = view('pdf', ['customers' => $customers, 'date' => $request->rm, 'vauchar_number' => $vaucher->track_id]);
        $html = mb_convert_encoding($view, 'HTML-ENTITIES', 'UTF-8');
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape');
        Storage::put('public/pdf/' . $request->rm . '_' . $vaucher->track_id . '.pdf', $pdf->output());
        $filename = $request->rm . '_' . $vaucher->track_id . '.pdf';

        $storevaucher = new Vaucher();
        $storevaucher->file_name = $filename;
        $storevaucher->gen_date = $request->rm;
        $storevaucher->user_id = Auth::user()->id;
        $storevaucher->vaucher_id = $vaucher->track_id;

        if ($storevaucher->save()) {
            foreach ($customers as $customer) {
                $cus = Customer::find($customer->id);
                $cus->vauchar_status = true;
                $cus->vauchar_number = $vaucher->track_id;
                $cus->save();
            }
            $vaucher->track_id = $vaucher->track_id + 1;
            $vaucher->save();
        }
        //Redirect::away($pdf->download('invoice.pdf'));
        return $pdf->download($request->rm . '.pdf');
    }
    public function nepaliPdf(Request $request)
    {
        $customer_ids = explode(',', $request->checkbox_id);
        $where = "id";
        $where_store = "";
        foreach ($customer_ids as $key => $value) {
            $where_store = $where_store . $where . "=" . $value . " OR ";
        }

        $where = rtrim($where_store, ' OR ');
        $where = $where." order by customer_id =0,customer_id ASC";
        $customers = DB::select("select * from customers where " . $where);



        return view('pdf1', ['customers' => $customers, 'date' => $request->rm]);
    }

    public function getVauchers()
    {
        $vauchers = Vaucher::all();
        return view('admin.customer.vauchers', ['vauchers' => $vauchers]);
    }
    public function myVauchers()
    {
        $vauchers = Vaucher::where('user_id', Auth::user()->id)->get();
        return view('admin.customer.myVaucher', ['vauchers' => $vauchers]);
    }

    public function viewVauchers($id)
    {
        $vaucher = Vaucher::find($id);
        $filename = $vaucher->file_name;
        $path = Storage::path('public/pdf/' . $filename);
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }



    public function sendMail($id)
    {
        $emailTemp = EmailTemplate::find(1);
        $currdate = date("Y-m-d");
        $customer = $customer = Customer::find($id);
        $details = [
            'name' => $customer->name,
            'subject' => $emailTemp->subject,
            'message' => $emailTemp->message,
            'contact' => $emailTemp->contact,
            'date' => $currdate
        ];
        \Mail::to($customer->customer_email)->send(new SendMail($details));
        return back();
    }

    function customerDetail($id)
    {
        $customer = Customer::find($id);

        return view('admin.customer.customerDetail', ['customer' => $customer]);
    }

    function deletedCustomerDetail($id)
    {
        $customer = Customer::find($id);
        return view('admin.customer.customerDetail', ['customer' => $customer]);
    }



    public function trash()
    {
        $customers = Customer::onlyTrashed()->get();
        return view('admin.trash.customer', ['customers' => $customers]);
    }

    public function showTrashed($id)
    {
        $customer = Customer::onlyTrashed()->find($id);
        return view('admin.customer.customerDetail', ['customer' => $customer]);
    }

    public function parmanentRemove($id)
    {
        $customer = Customer::onlyTrashed()->findOrFail($id);;
        $customer->forceDelete();
        return back();
    }

    public function recoverCustomer($id)
    {
        $customer = Customer::onlyTrashed()->findOrFail($id);
        $customer->restore();
        return back();
    }
}
