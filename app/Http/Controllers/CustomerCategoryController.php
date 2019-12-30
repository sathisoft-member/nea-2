<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerCategory;

class CustomerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer_categories = CustomerCategory::all();
        return view('admin.customer_category.list',compact('customer_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.customer_category.add');
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
            'name'=>'required',
        ]);
        $customer_category = new CustomerCategory();
        $customer_category->name      =   $request->name;
        $customer_category->save();
        return back()->with('message','added successfully');
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
        $customer_category = CustomerCategory::find($id);
         return view('admin.customer_category.edit',compact('customer_category'));
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
            'name'=>'required',
        ]);
        $customer_category = CustomerCategory::find($id);
        $customer_category->name      =   $request->name;
        $customer_category->save();
        return redirect()->route('customer_category.index')->with('message','successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CustomerCategory::destroy($id);
        return redirect()->route('customer_category.index')->with('message','successfully deleted');
    }
}
