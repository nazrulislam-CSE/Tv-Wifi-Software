<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use Session;

class BuildingController extends Controller
{

    // ================= START index METHOD ================= //
    public function index()
    {
        $buildings  = Building::latest()->get();
        return view('admin.building.index',compact('buildings'));

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
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $building = Building::where('name',$request->name)->first();

        if($building){

            Session::flash('info','Building already Created.');
            return redirect()->back();
        }else{

            $building = Building::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address
            ]);
        }

        Session::flash('success','Building Inserted Successfully');
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
        $building = Building::find($id);
        return view('admin.building.edit_building',compact('building'));
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
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $building = Building::find($id);
        $building->name = $request->name;
        $building->phone = $request->phone;
        $building->address = $request->address;
        $building->save();

        Session::flash('success','Building Updated Successfully.');
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
        $building = Building::find($id);

        $building->delete();

        Session::flash('info','Building Permanently Deleted Successfully.');
        return redirect()->back();

    }

    public function active($id){
        $building = Building::find($id);
        $building->status = 1;
        $building->save();

        Session::flash('success','Successfully Building Changed.');
        return redirect()->back();
    }

    public function inactive($id){
        $building = Building::find($id);
        $building->status = 0;
        $building->save();

        Session::flash('success','Successfully Building Changed.');
        return redirect()->back();
    }
}
