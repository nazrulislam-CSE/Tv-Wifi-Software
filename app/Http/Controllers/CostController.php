<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cost;
use Session;

class CostController extends Controller
{

    // ================= START index METHOD ================= //
    public function index()
    {
        $costs  = Cost::latest()->get();
        return view('admin.cost.index',compact('costs'));

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
            'amount' => 'required',
            'description' => 'required'
        ]);


        $cost = Cost::create([
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        Session::flash('success','Cost Inserted Successfully');
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
        $cost = Cost::find($id);
        return view('admin.cost.edit',compact('cost'));
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
            'amount' => 'required',
            'description' => 'required'
        ]);

        $cost = Cost::find($id);
        $cost->amount = $request->amount;
        $cost->description = $request->description;
        $cost->save();

        Session::flash('success','Cost Updated Successfully.');
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
        $cost = Cost::find($id);

        $cost->delete();

        Session::flash('info','Cost Permanently Deleted Successfully.');
        return redirect()->back();

    }

    public function active($id){
        $cost = Cost::find($id);
        $cost->status = 1;
        $cost->save();

        Session::flash('success','Successfully Cost Changed.');
        return redirect()->back();
    }

    public function inactive($id){
        $cost = Cost::find($id);
        $cost->status = 0;
        $cost->save();

        Session::flash('success','Successfully Cost Changed.');
        return redirect()->back();
    }
		 public function daterange(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;		
        $costs = Cost::select()
						->latest()
						->where('status', '0')
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
						->Paginate(100);
		$tcashs = Cost::select()
						->latest()
						->where('status', '0')
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
						->sum('amount');  
						
        return view('admin.cost.daterange', compact('startDate', 'endDate', 'tcashs', 'costs'))
				->with('i', (request()->input('page', 1) - 1) * 100);
		
    } 
}
