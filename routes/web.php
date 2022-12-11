<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function(){
    return App\Models\Client::find(2)->floats;
});


Route::group(['middleware'=>['auth:sanctum', 'verified']], function(){

// ==================== START DASHBOARD SECTION ================== //
Route::get('/dashboard','DashboardController@index')->name('dashboard');
Route::get('/todaybill','DashboardController@todaybill')->name('todaybill');
Route::get('/monthbill','DashboardController@monthbill')->name('monthbill');
Route::get('/todaycash','DashboardController@todaycash')->name('todaycash');
Route::get('/monthcash','DashboardController@monthcash')->name('monthcash');
Route::get('/todaycost','DashboardController@todaycost')->name('todaycost');
Route::get('/monthcost','DashboardController@monthcost')->name('monthcost');
// ==================== END DASHBOARD SECTION ================== //

// ==================== START PACKAGE SECTION ================== //
Route::get('/package','PackageController@index')->name('package.all');
Route::post('/package-store','PackageController@store')->name('package.store');
Route::get('/package-edit/{id}','PackageController@edit')->name('package.edit');
Route::post('/package-update/{id}','PackageController@update')->name('package.update');
Route::get('/package-delete/{id}','PackageController@destroy')->name('package.delete');
Route::get('/package_active/{id}','PackageController@active')->name('package.active');
Route::get('/package_inactive/{id}','PackageController@inactive')->name('package.in_active');
// ==================== END PACKAGE SECTION ================== //

// ==================== START FLOAT SECTION ================== //
Route::get('/float','floatController@index')->name('float.all');
Route::post('/float-store','floatController@store')->name('float.store');
Route::get('/float-edit/{id}','floatController@edit')->name('float.edit');
Route::post('/float-update/{id}','floatController@update')->name('float.update');
Route::get('/float-delete/{id}','floatController@destroy')->name('float.delete');
Route::get('/float_active/{id}','floatController@active')->name('float.active');
Route::get('/float_inactive/{id}','floatController@inactive')->name('float.in_active');
// ==================== END FLOAT SECTION ================== //	

// ==================== START FLOAT SECTION ================== //
Route::get('/client-add','ClientController@create')->name('client.add');

Route::get('/client-show','ClientController@show')->name('client.show');


Route::post('/client-store','ClientController@store')->name('client.store');
Route::get('/client-all','ClientController@index')->name('client.all');
Route::post('/float-update/{id}','floatController@update')->name('float.update');
Route::get('/client-edit/{id}','ClientController@edit')->name('client.edit');
Route::post('/client-update/{id}','ClientController@update')->name('client.update');
Route::get('/client-delete/{id}','ClientController@destroy')->name('client.delete');
Route::get('/client_active/{id}','ClientController@active')->name('client.active');
Route::get('/client_inactive/{id}','ClientController@inactive')->name('client.in_active');
Route::get('/client_show/{id}','ClientController@show')->name('client.show');
// ==================== END FLOAT SECTION ================== //	

// ==================== START Building SECTION ================== //

Route::get('/building-all','BuildingController@index')->name('building.index');
Route::post('/building-store','BuildingController@store')->name('building.store');
Route::get('/building-edit/{id}','BuildingController@edit')->name('building.edit');
Route::post('/building-update/{id}','BuildingController@update')->name('building.update');
Route::get('/building-delete/{id}','BuildingController@destroy')->name('building.delete');
Route::get('/building_active/{id}','BuildingController@active')->name('building.active');
Route::get('/building_inactive/{id}','BuildingController@inactive')->name('building.in_active');

// ==================== END Building SECTION ================== //

// ==================== START Building SECTION ================== //

Route::get('/cash-all','CashController@index')->name('cash.index');
Route::post('/cash-store','CashController@store')->name('cash.store');
Route::get('/cash-edit/{id}','CashController@edit')->name('cash.edit');
Route::post('/cash-update/{id}','CashController@update')->name('cash.update');
Route::get('/cash-delete/{id}','CashController@destroy')->name('cash.delete');
Route::get('/cash_active/{id}','CashController@active')->name('cash.active');
Route::get('/cash_inactive/{id}','CashController@inactive')->name('cash.in_active');

Route::get('/cash-daterange','CashController@daterange')->name('cash.daterange');	
  
// ==================== END Building SECTION ================== //

// ==================== START Building SECTION ================== //

Route::get('/cost-all','CostController@index')->name('cost.index');
Route::post('/cost-store','CostController@store')->name('cost.store');
Route::get('/cost-edit/{id}','CostController@edit')->name('cost.edit');
Route::post('/cost-update/{id}','CostController@update')->name('cost.update');
Route::get('/cost-delete/{id}','CostController@destroy')->name('cost.delete');
Route::get('/cost_active/{id}','CostController@active')->name('cost.active');
Route::get('/cost_inactive/{id}','CostController@inactive')->name('cost.in_active');
Route::get('/cost-daterange','CostController@daterange')->name('cost.daterange');	
  
// ==================== END Building SECTION ================== //

// ==================== START Building SECTION ================== //

Route::get('/customer-all','CustomerController@index')->name('customer.index');
Route::post('/customer-store','CustomerController@store')->name('customer.store');
Route::get('/customer-edit/{id}','CustomerController@edit')->name('customer.edit');
Route::post('/customer-update/{id}','CustomerController@update')->name('customer.update');
Route::get('/customer-delete/{id}','CustomerController@destroy')->name('customer.delete');
Route::get('/customer_active/{id}','CustomerController@active')->name('customer.active');
Route::get('/customer_inactive/{id}','CustomerController@inactive')->name('customer.in_active');

// ==================== END Bill SECTION ================== /

// Bill //
Route::get('/bill-all','BillController@index')->name('bill.index');
Route::get('/client-bill/{id}','BillController@manageclient')->name('client.manageclient');
Route::post('/client-billupdate/{id}','BillController@billupdate')->name('client.billupdate');
Route::post('/client-billpaymentupdate/{id}','BillController@billpaymentupdate')->name('client.billpaymentupdate');
Route::get('/clientbill-delete/{id}','BillController@destroy')->name('clientbill.delete');
Route::get('/bill-daterange','BillController@daterange')->name('bill.daterange');	
Route::get('/bill-singledaterange','BillController@singledaterange')->name('bill.singledaterange');
  
});

// Complan //
Route::get('/add-complan','PackageController@complan_add')->name('add.complan');
Route::post('/store-complan','PackageController@complan_store')->name('store.complan');
Route::get('/list-complan','PackageController@list_complan')->name('list.complan');
Route::get('/edit-complan/{id}','PackageController@complan_edit')->name('edit.complan');
Route::post('/update-complan/{id}','PackageController@complan_update')->name('update.complan');
Route::get('/delete-complan/{id}','PackageController@complan_delete')->name('delete.complan');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
