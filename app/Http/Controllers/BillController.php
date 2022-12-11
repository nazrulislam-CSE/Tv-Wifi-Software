<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Building;
use App\Models\Billpayment;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BillController extends Controller
{
    public function index()
    {
		
		 $buildings  = Building::latest()->get();
       return view('admin.bill.index',compact('buildings'));
    }
	
	public function manageclient($id)
    {
                    $tttfrst=date("Y-m-0");
        	        $ttt=date("Y-m-d");
				    $myadminrole=Auth::user()->adminrole;	
					
					
		$coldlients = Client::latest()->where('paymentdate', '0')->where('building_id', $id)->get()->sortBy("flat_no");
					 
            if($myadminrole > 25){
             $clients = Client::latest()->where('building_id', $id)->get()->sortBy("flat_no");
            }else{
            $clients = Client::latest()->where('building_id', $id)->get()->sortBy("flat_no");
            }  
             
        return view('admin.bill.manage_client',compact('clients'));
    }
	 
	 
	 public function billupdate(Request $request, $id)
    {
       $this->validate($request,[
            'buildingname' => 'required',
            'flat_no' => 'required',
            'phone' => 'required',
            'package_amount' => 'required',
            'package_name' => 'required',
            'cardno' => 'required',
        ]);
		$status='1';
		
        $building = Billpayment::create([
            'building_id' => $request->buildingname,
            'phone' => $request->phone,
            'flat_no' => $request->flat_no,
            'bill_collect' => $request->package_amount,
            'status' => $status,
    		'client_id' => $id,
    		'card_no' => $request->cardno,
            'package_id' => $request->package_name
		]);
		$ttt=date("Y-m-d");
		$ccurentdate=$ttt;
		
		$client = Client::find($id);
        $client->paymentdate = $ccurentdate;
        $client->update();

        Session::flash('success','Bill Payment Updated Successfully.');
        return redirect()->back();
    }
	
	 public function billpaymentupdate(Request $request, $id)
    {
       $this->validate($request,[
            'buildingname' => 'required',
            'flat_no' => 'required',
            'phone' => 'required',
            'package_amount' => 'required',
            'package_name' => 'required',
        ]);
		
        $building = Billpayment::where('id', $id)->update([
        'building_id' => $request->buildingname,
        'phone' => $request->phone,
        'flat_no' => $request->flat_no,
        'bill_collect' => $request->package_amount,
        'package_id' => $request->package_name
		]);

        Session::flash('success','Bill Payment Updated Successfully.');
        return redirect()->back();
    }
	
	
	
    public function destroy($id)
    {
        
		$clientsghy = Billpayment::where('id', $id)->first();
		$clienttid =$clientsghy->client_id;
		$ffpp='0';
		$client = Client::where('id', $clienttid)->update(['paymentdate' => $ffpp]);
		
		$client = Billpayment::find($id);
		$client->delete();

		Session::flash('info','Client Permanently Deleted Successfully.');
        return redirect()->back();

    }
	 public function daterange(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;		
        $cashs = Billpayment::select()
						->latest()
						->where('status', '1')
						->where('handcash', '1')
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
						->Paginate(100);
		$tcashs = Billpayment::select()
						->latest()
						->where('status', '1')
						->where('handcash', '1')
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
						->sum('bill_collect');
		$buildings = Building::all();
        				
        return view('admin.bill.daterange', compact('buildings', 'startDate', 'endDate', 'tcashs', 'cashs'))
				->with('i', (request()->input('page', 1) - 1) * 100);
		
    } 
	
	 public function singledaterange(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;		
        $csspsrc = $request->sspsrc;		
        $cashs = Billpayment::select()
						->latest()
						->where('status', '1')
						->where('handcash', '1')
						->where('building_id', $csspsrc)
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
						->Paginate(100);
		$tcashs = Billpayment::select()
						->latest()
						->where('status', '1')
						->where('handcash', '1')
						->where('building_id', $csspsrc)
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
						->sum('bill_collect');  
						
        return view('admin.bill.singledaterange', compact('startDate', 'endDate', 'tcashs', 'cashs'))
				->with('i', (request()->input('page', 1) - 1) * 100);
		
    } 
	
}
