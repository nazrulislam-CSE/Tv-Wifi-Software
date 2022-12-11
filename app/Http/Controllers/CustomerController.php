<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Hash;  


class CustomerController extends Controller
{

    // ================= START index METHOD ================= //
    public function index()
    {
        $customers  = User::latest()->get();
        return view('admin.user.index',compact('customers'));

    } // end method

    // ================= START index METHOD ================= //

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
            'user_name' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ]);

		$sstatus = '1';
		$password=$request->password;
		$hashedPassword = Hash::make($password);
        $customer = User::create([
            'email' => $request->user_name,
            'name' => $request->name,
			'phone' => $request->phone,
			'adminrole' => $sstatus,
            'password' => $hashedPassword,
        ]);

        Session::flash('success','User Inserted Successfully');
        return redirect()->back();
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
        $customer = User::find($id);
        return view('admin.user.edit',compact('customer'));
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
            'user_name' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ]);
		$sstatus='1';
		$password=$request->password;
		$hashedPassword = Hash::make($password);

        $customer = User::find($id);
        $customer->email = $request->user_name;
        $customer->name = $request->name;
        $customer->phone = $request->phone;
		$customer->adminrole = $sstatus;
        $customer->password = $hashedPassword;
        $customer->save();

        Session::flash('success','User Updated Successfully.');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = User::find($id);

        $customer->delete();

        Session::flash('info','User Permanently Deleted Successfully.');
        return redirect()->back();

    }

    public function active($id){
        $customer = User::find($id);
        $customer->status = 1;
        $customer->save();

        Session::flash('success','Successfully user Changed.');
        return redirect()->back();
    }

    public function inactive($id){
        $customer = User::find($id);
        $customer->status = 0;
        $customer->save();

        Session::flash('success','Successfully user Changed.');
        return redirect()->back();
    }
}
