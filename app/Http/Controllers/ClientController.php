<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Building;
use App\Models\Package;
use App\Models\Billpayment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myadminrole=Auth::user()->adminrole;
        $clients = Client::get()->sortBy("flat_no");
		return view('admin.client.manage_client',compact('clients','myadminrole'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buildings = Building::all();
        $packages = Package::all();
        return view('admin.client.create_client', compact('buildings','packages'));
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
            'building_id' => 'required',
            'package_id' => 'required',
            'flat_no' => 'required',
            'card_no' => 'required',
            'phone' => 'required',
        ]);
        
        $rr=$request->package_id;
        $tt=Package::where('id', $rr)->first();
        $ttootal=$tt->package_amount;
        
        $client = Client::create([
            'building_id' => $request->building_id,
            'package_id' => $request->package_id,
            'package_amount' => $ttootal,
            'flat_no' => $request->flat_no,
            'card_no' => $request->card_no,
            'phone' => $request->phone
        ]);


        Session::flash('success','Client Inserted Successfully');
        return redirect()->route('client.all');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clients = Billpayment::latest()->where('client_id', $id)->get();
        $userrole =Auth::user()->adminrole;
        return view('admin.client.show',compact('userrole', 'clients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        $buildings = Building::all();
        $packages = Package::all();

        return view('admin.client.edit_client',compact('client','buildings','packages'));
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
            'building_id' => 'required',
            'package_id' => 'required',
            'flat_no' => 'required',
            'card_no' => 'required',
            'phone' => 'required',
        ]);
        $rr=$request->package_id;
        $tt=Package::where('id', $rr)->first();
        $ttootal=$tt->package_amount;
        
        $client = Client::find($id);

        $client->building_id = $request->building_id;
        $client->package_id = $request->package_id;
        $client->flat_no = $request->flat_no;
        $client->package_amount = $ttootal;
        $client->card_no = $request->card_no;
        $client->phone = $request->phone;

        $client->update();

        Session::flash('success','Client Updated Successfully');
        return redirect()->route('bill.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);

        $client->delete();

        Session::flash('info','Client Permanently Deleted Successfully.');
        return redirect()->back();

    }

    public function active($id){
        $client = Client::find($id);
        $client->status = 1;
        $client->save();

        Session::flash('success','Successfully Client Changed.');
        return redirect()->back();
    }

    public function inactive($id){
        $client = Client::find($id);
        $client->status = 0;
        $client->save();

        Session::flash('success','Successfully Client Changed.');
        return redirect()->back();
    }
}
