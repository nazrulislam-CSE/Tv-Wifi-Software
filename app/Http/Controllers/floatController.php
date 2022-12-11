<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Floats;
use Session;

class floatController extends Controller
{

    // ================= START index METHOD ================= //
    public function index()
    {
        $floats  = Floats::latest()->get();
        return view('admin.float.all_float',compact('floats'));

    } // end method

    // ================= START index METHOD ================= //

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
        $this->validate($request,[

            'float_name' => 'required',
            'float_address' => 'required'
        ]);

        $float = Floats::where('float_name',$request->float_name)->first();

        if($float){

            Session::flash('info','Float already Created.');
            return redirect()->back();
        }else{

            $float = Floats::create([
                'float_name' => $request->float_name,
                'float_address' => $request->float_address
            ]);
        }

        Session::flash('success','Room Inserted Successfully');
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
        $float = Floats::find($id);
        return view('admin.float.edit_float',compact('float'));
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

            'float_name' => 'required',
            'float_address' => 'required'
        ]);

        $float = Floats::find($id);
        $float->float_name = $request->float_name;
        $float->float_address = $request->float_address;
        $float->save();

        Session::flash('success','Room Updated Successfully.');
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
        $float = Floats::find($id);

        $float->delete();

        Session::flash('success','Room Permanently Deleted Successfully.');
        return redirect()->back();

    }

    public function active($id){
        $float = Floats::find($id);
        $float->status = 1;
        $float->save();

        Session::flash('success','Successfully Room Changed.');
        return redirect()->back();
    }

    public function inactive($id){
        $float = Floats::find($id);
        $float->status = 0;
        $float->save();

        Session::flash('success','Successfully Room Changed.');
        return redirect()->back();
    }

}
