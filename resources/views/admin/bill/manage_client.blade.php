@extends('layouts.app2')
@section('content')
<div class="content-wrapper">
 @foreach($clients as $clienth) @endforeach
    <!-- Main content -->
  <div class="content">
    <div class="container-fluied">
      <div class="row mt-3">
       <div class="col-12">
           <div class="card py-3">
             <div class="d-flex justify-content-between align-items-center" style="padding:5px">
                <h3 class="card-title pl-3">  @if(!empty($clienth->flat_no))
                    {{ $clienth->building->name }} এর Building 
                    @else
                    Details
                    @endif
                    
                  
                    </h3>
                
             </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Action</th>
                    <th>Room</th>
                    <th>Amount</th>
                    <th>Phone</th>
                    <th>Card No</th>
                    <th>Package</th>
                    <th>Building</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  @php
                $i = 1;
              @endphp
              <tbody>
                @foreach($clients as $client)
                  <tr>
                    <td>{{ $i++ }}</td>
                   <td>
                    @php
					$ttt=date("Y-m");
					$tyty=$client->paymentdate;
					$trtr=substr($tyty,0,7);
					@endphp
					
                        @if($trtr == $ttt)      
							<button class="btn btn-success btn-sm">Paid</button>
							 @else
							<a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#viewModal{{ $client->id }}">Pay</a>
						@endif
						
                        <!-- Edit building Modal -->
                        <div class="modal fade" id="viewModal{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger">
                                <h5 class="modal-title" id="exampleModalLongTitle">Pay Bill</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                 <form action="{{ route('client.billupdate',['id'=>$client->id] )}}" method="post">
                                @csrf

                                  <div class="form-group">
                                    @error('buildingname')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" name="buildingname" class="form-control" id="buildingname" value="{{ $client->building->name }}" placeholder="Name" style="background:transparent" readonly>
                                  </div>
                                  <div class="form-group">
                                    @error('flat_no')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" name="flat_no" class="form-control" id="flat_no" value="{{ $client->flat_no }}" placeholder="flat No" style="background:transparent" readonly>
                                  </div>
									<div class="form-group">
                                    @error('phone')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" name="phone" class="form-control" id="phone" value="{{ $client->phone }}" placeholder="Phone" style="background:transparent" readonly>
                                  </div>
                                  <div class="form-group">
                                    @error('package_name')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" name="package_name" class="form-control" id="package_name" value="{{ $client->package->package_name }}" placeholder="Package" style="background:transparent" readonly>
                                  </div>
								 <div class="form-group">
                                    @error('package_amount')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="number" name="package_amount" class="form-control" id="package_amount" value="{{ $client->package->package_amount }}" placeholder="Amount" style="background:transparent" readonly>
                                  <input type="hidden" name="cardno" value="{{ $client->card_no }}" />
								  
								  </div>
                                  <div class="form-group float-right" >
                                    <input type="submit" class="btn btn-primary" value="Pay Now">
                                  </div>
                                </form>

                              </div>
                            </div>
                          </div>
                        </div>
					
					
					</td>
                    <td>{{ $client->flat_no }}</td>
                    <td>{{ $client->package->package_amount }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->card_no }}</td>
                    <td>{{ $client->package->package_name }}</td>
                    <td>{{ $client->building->name }}</td>
                    <td>
					@php
        			    $myadminrole=Auth::user()->adminrole;
        			@endphp
        			@if($myadminrole=='27')
                        <a href="{{ route('client.edit',['id'=>$client->id]) }}"  class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                    @endif
                        
					  <a href="{{ route('client.show',['id'=>$client->id]) }}"  class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
  <footer class="main-footer">
   <strong style="color:#03228f;">&copy; <?php echo date('Y'); ?> All Rights Reserved.</strong>
   <div class="float-right d-none d-sm-inline-block">
       <strong style="color:#0e73e4;" id="by">Developed by <a  href="#">Nazrul Islam</a></strong>
   </div>
</footer>
@endsection