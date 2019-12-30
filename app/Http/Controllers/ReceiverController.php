<?php

namespace App\Http\Controllers;

use App\Receiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ReceiverController extends Controller
{
    public function index()
    {
        $receivers = Receiver::all();
        return view('admin.receiver.index', compact('receivers'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'image' => 'required',
        ]);
        $receiver = new Receiver();
        if ($request->image) {
            if ($request->image->getClientOriginalName()) {
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $path = $request->image->move('receiver_image', $file);
            }
        } else {
            $path = '';
        }
        $receiver->image = $path;
        $receiver->name = $request->name;
        $receiver->phone = $request->phone;

        $receiver->save();
        return back()->with('message', 'successfully added');
    }
    public function edit($id)
    {
        return $receiver = Receiver::find($id);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function receiverUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
        ]);
        $receiver = Receiver::find($request->id);
        if ($request->hasFile('image')) {
            File::delete($receiver->image);
            $extension = "." . $request->image->getClientOriginalExtension();
            $name = basename($request->image->getClientOriginalName(), $extension) . time();
            $name = $name . $extension;
            $path =  $request->image->move('receiver_image', $name);
            $receiver->image = $path;
        }
        $receiver->name = $request->name;
        $receiver->phone = $request->phone;

        $receiver->save();
        return back()->with('message', 'Successfully updated');
        dd($request);
    }
}
