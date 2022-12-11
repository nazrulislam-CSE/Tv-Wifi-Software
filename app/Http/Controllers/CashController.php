<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billpayment;
use Session;

class CashController extends Controller
{

    // ================= START index METHOD ================= //
    public function index()
    {
        $cashs  = Billpayment::latest()->where('handcash', 'handcash')->get();
        return view('admin.cash.index',compact('cashs'));

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
		$hggbfn='handcash';

        $cash = Billpayment::create([
            'bill_collect' => $request->amount,
            'description' => $request->description,
            'handcash' => $hggbfn,
			
        ]);

        Session::flash('success','Cash Inserted Successfully');
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
        $cash = Billpayment::find($id);
        return view('admin.cash.edit',compact('cash'));
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

        $cash = Billpayment::find($id);
        $cash->bill_collect = $request->amount;
        $cash->description = $request->description;
        $cash->save();

        Session::flash('success','Cash Updated Successfully.');
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
        $cash = Billpayment::find($id);

        $cash->delete();

        Session::flash('info','Cash Permanently Deleted Successfully.');
        return redirect()->back();

    }

    public function active($id){
        $cash = Billpayment::find($id);
        $cash->status = 0;
        $cash->save();

        Session::flash('success','Successfully Cash Changed.');
        return redirect()->back();
    }

    public function inactive($id){
        $cash = Billpayment::find($id);
        $cash->status = 1;
        $cash->save();

        Session::flash('success','Successfully Cash Changed.');
        return redirect()->back();
  }
  
  
	 public function daterange(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;		
        $cashs = Billpayment::select()
						->latest()
						->where('status', '1')
						->where('handcash', 'handcash')
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
						->Paginate(100);
		$tcashs = Billpayment::select()
						->latest()
						->where('status', '1')
						->where('handcash', 'handcash')
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
						->sum('bill_collect');  
						
        return view('admin.cash.daterange', compact('startDate', 'endDate', 'tcashs', 'cashs'))
				->with('i', (request()->input('page', 1) - 1) * 100);
		
    }  
}
