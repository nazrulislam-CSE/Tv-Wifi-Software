<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Client;
use App\Models\Complan;
use Session;

class PackageController extends Controller
{

    // ================= START index METHOD ================= //
    public function index()
    {
        $packages  = Package::latest()->get();
        return view('admin.package.all_package',compact('packages'));

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

            'package_name' => 'required',
            'package_amount' => 'required'
        ]);

        $package = Package::where('package_name',$request->package_name)->first();


        if($package){

            Session::flash('info','Package already Created.');
            return redirect()->back();
        }else{

            $package = Package::create([
                'package_name' => $request->package_name,
                'package_amount' => $request->package_amount
            ]);
        }

        Session::flash('success','Package Inserted Successfully');
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
        $package = Package::find($id);
        return view('admin.package.edit_package',compact('package'));
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

            'package_name' => 'required',
            'package_amount' => 'required'
        ]);

        $package = Package::find($id);
        $package->package_name = $request->package_name;
        $package->package_amount = $request->package_amount;
        $package->save();

         Client::where('package_id', $id)->update(['package_amount' => $request->package_amount]);

        Session::flash('success','Package Updated Successfully.');
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
        $package = Package::find($id);

        $package->delete();

        Session::flash('info','Package Permanently Deleted Successfully.');
        return redirect()->back();

    }

    public function active($id){
        $package = Package::find($id);
        $package->status = 1;
        $package->save();

        Session::flash('success','Successfully Package Changed.');
        return redirect()->back();
    }

    public function inactive($id){
        $package = Package::find($id);
        $package->status = 0;
        $package->save();

        Session::flash('success','Successfully Package Changed.');
        return redirect()->back();
    }
    
    
    // Complan Controller //
    
    public function complan_add(){
         return view('admin.complan.add_complan');
    }
    
    public function complan_store(Request $request)
    {
        $this->validate($request,[

            'description' => 'required',
        ]);


            $complan = Complan::create([
                'description' => $request->description
            ]);

        Session::flash('success','Complan Inserted Successfully');
        return redirect()->back();
    }
    
    public function list_complan()
    {
        $complans  = Complan::latest()->get();
        return view('admin.complan.list_complan',compact('complans'));

    } // end method
    
     public function complan_edit($id)
    {
        $complans = Complan::find($id);
        return view('admin.complan.edit_complan',compact('complans'));
    }
    
    public function complan_update(Request $request, $id)
    {
       $this->validate($request,[

            'description' => 'required',
        ]);


        $complan = Complan::find($id);
        $complan->description = $request->description;
    
        $complan->update();

       

        Session::flash('success','Complan Updated Successfully.');
        return redirect()->back();
    }
    
    public function complan_delete($id)
    {
        $complan = Complan::find($id);

        $complan->delete();

        Session::flash('info','Complan Permanently Deleted Successfully.');
        return redirect()->back();

    }
}
