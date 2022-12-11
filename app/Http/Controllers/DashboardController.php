<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;  
use App\Models\User;   
use App\Models\Building;   
use App\Models\Client;   
use App\Models\Package;   
use App\Models\Billpayment;  
use App\Models\Cost; 
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index(){
	   $myadminrole=Auth::user()->adminrole;
	   $svndate = Carbon::now()->subDays(7);
	   $thrtydate= Carbon::now()->subDays(30);
	   

       $paidbills  = Client::whereYear('paymentdate', Carbon::now()->year)->whereMonth('paymentdate', Carbon::now()->month)->sum('package_amount');

       $mnthbills  = Client::where('status', '0')->sum('package_amount');
       $tttdue= $mnthbills-$paidbills;
       
	   $buildings  = Building::latest()->count();
       $clients  = Client::latest()->where('status', '0')->count();
       $packages  = Package::latest()->where('status', '0')->count();
       $users  = User::latest()->count();
       
	   $todaybills  = Billpayment::latest()->where('handcash', '1')->whereDate('created_at', Carbon::today())->where('status', '1')->sum('bill_collect');
       $thismnthbills  = Billpayment::latest()->where('handcash', '1')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('status', '1')->sum('bill_collect');
       
	   $todaycashs  = Billpayment::latest()->where('handcash', 'handcash')->whereDate('created_at', Carbon::today())->where('status', '1')->sum('bill_collect');
       $thismnthcashs  = Billpayment::latest()->where('handcash', 'handcash')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('status', '1')->sum('bill_collect');
       
	   $tbills  = Billpayment::latest()->where('status', '1')->sum('bill_collect');
       $lstsvnbills  = Billpayment::latest()->where('created_at', '>=', $svndate)->where('status', '1')->sum('bill_collect');
       $lstthrtybills  = Billpayment::latest()->where('created_at', '>=', $thrtydate)->where('status', '1')->sum('bill_collect');
       $lstmnthbills  = Billpayment::latest()->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth()->month)->where('status', '1')->sum('bill_collect');
       $thisyearbills  = Billpayment::latest()->whereYear('created_at', Carbon::now()->year)->where('status', '1')->sum('bill_collect');
       $lstyearbills  = Billpayment::latest()->whereYear('created_at', Carbon::now()->subYear()->year)->where('status', '1')->sum('bill_collect');
       
	   
	   
	   $todaycosts  = Cost::latest()->whereDate('created_at', Carbon::today())->where('status', '0')->sum('amount');
       $thismnthcosts  = Cost::latest()->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('status', '0')->sum('amount');
       
	   $tcosts  = Cost::latest()->where('status', '0')->sum('amount');
       $lstsvncosts  = Cost::latest()->where('created_at', '>=', $svndate)->where('status', '0')->sum('amount');
       $lstthrtycosts  = Cost::latest()->where('created_at', '>=', $thrtydate)->where('status', '0')->sum('amount');
       $lstmnthcosts  = Cost::latest()->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth()->month)->where('status', '0')->sum('amount');
       $thisyearcosts  = Cost::latest()->whereYear('created_at', Carbon::now()->year)->where('status', '0')->sum('amount');
       $lstyearcosts  = Cost::latest()->whereYear('created_at', Carbon::now()->subYear()->year)->where('status', '0')->sum('amount');
       
	   return view('dashboard',compact('todaycashs', 'thismnthcashs', 'tttdue', 'myadminrole', 'buildings', 'clients', 'packages', 'users', 
	   'tbills', 'todaybills', 'lstsvnbills', 'lstthrtybills', 'thismnthbills', 'lstmnthbills', 'thisyearbills', 'lstyearbills',
	   'tcosts', 'todaycosts', 'lstsvncosts', 'lstthrtycosts', 'thismnthcosts', 'lstmnthcosts', 'thisyearcosts', 'lstyearcosts'));
    }
    
    
    
    
      public function todaybill(){

     $userrole=Auth::user()->adminrole;
	    
	   $todaybills  = Billpayment::latest()->where('handcash', '1')->whereDate('created_at', Carbon::today())->where('status', '1')->sum('bill_collect');
      $clients  = Billpayment::latest()->where('handcash', '1')->whereDate('created_at', Carbon::today())->where('status', '1')->get();
    
     return view('admin.client.billpaid',compact('todaybills', 'userrole', 'clients'));
    
      }
    
        public function monthbill(){

     $userrole=Auth::user()->adminrole;
	    
	   $todaybills  = Billpayment::latest()->where('handcash', '1')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('status', '1')->sum('bill_collect');
      $clients  = Billpayment::latest()->where('handcash', '1')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('status', '1')->get();
    
     return view('admin.client.monthbillpaid',compact('todaybills', 'userrole', 'clients'));
    
      }
    
    
     public function todaycash(){

     $userrole=Auth::user()->adminrole;
	    
	   $todaybills  = Billpayment::latest()->where('handcash', 'handcash')->whereDate('created_at', Carbon::today())->where('status', '1')->sum('bill_collect');
      $clients  = Billpayment::latest()->where('handcash', 'handcash')->whereDate('created_at', Carbon::today())->where('status', '1')->get();
    
     return view('admin.client.cashpaid',compact('todaybills', 'userrole', 'clients'));
    
      }
    
        public function monthcash(){

     $userrole=Auth::user()->adminrole;
	    
	   $todaybills  = Billpayment::latest()->where('handcash', 'handcash')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('status', '1')->sum('bill_collect');
      $clients  = Billpayment::latest()->where('handcash', 'handcash')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('status', '1')->get();
    
     return view('admin.client.monthcashpaid',compact('todaybills', 'userrole', 'clients'));
    
      }
    
         public function todaycost(){

     $userrole=Auth::user()->adminrole;
	    
	   $todaybills  = Cost::latest()->whereDate('created_at', Carbon::today())->where('status', '0')->sum('amount');
      $costs  =  Cost::latest()->whereDate('created_at', Carbon::today())->where('status', '0')->get();
    
     return view('admin.cost.costpaid',compact('todaybills', 'userrole', 'costs'));
    
      }
    
        public function monthcost(){

     $userrole=Auth::user()->adminrole;
	    
	   $todaybills  =  Cost::latest()->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('status', '0')->sum('amount');
      $costs  =  Cost::latest()->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('status', '0')->get();
    

     return view('admin.cost.monthcostpaid',compact('todaybills', 'userrole', 'costs'));
    
      }

}
