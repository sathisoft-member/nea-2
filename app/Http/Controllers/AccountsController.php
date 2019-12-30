<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Auth;


class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin =User::where('status',1)->get();
        return view('admin.accounts.list',['admins'=>$admin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.accounts.add');
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
            'email'=>'required',
            'password' => 'min:6|required_with:conform_passwrd|same:conform_passwrd',
            'image'=>'required',
        ]);
         $admin = new User();
         if($request->image){
           if($request->image->getClientOriginalName()){
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis').rand(1,99999).'.'.$ext;
                $path=$request->image->move('admin_image',$file);
            }
        }else{
            $path = '';
        }
        $admin->image = $path;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->status = 1;
        $admin->save();
        return back()->with('message','successfully added');
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
        $admin = User::find($id);
        return view('admin.accounts.edit',compact("admin"));
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
            'email'=>'required'
        ]);
         $admin = User::find($id);

         if($request->hasFile('image')){
           File::delete($admin->image);
           $extension = ".".$request->image->getClientOriginalExtension();
           $name = basename($request->image->getClientOriginalName(), $extension).time();
           $name = $name.$extension;
           $path =  $request->image->move('admin_image',$name);
           $admin->image = $path;
         }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->status = 1;
        $admin->save();
        return back()->with('message','Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         User::destroy($id);
         return back()->with('message','successfully deleted');
    }

    public function getChangePassword(){
        return view('admin.accounts.changePassword');
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'password' => 'min:6',
            'confirm_password' => 'required_with:password|same:password|min:6'
        ]);
        $user=User::find(Auth::user()->id);
        $user->password=bcrypt($request->password);
        $user->save();
        return back()->with('message',"Password Successfully Changed");
    }

    public function getProfile(){
        dd("Wpr");
        $id=Auth()->user()->id;
        $user=User::find($id);
        return view('admin.accounts.profile',compact('user'));
    }
}
