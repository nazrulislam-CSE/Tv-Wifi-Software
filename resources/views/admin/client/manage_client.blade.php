@extends('layouts.app2')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
  <div class="content">
    <div class="container-fluied">
      <div class="row mt-3">
       <div class="col-12">
           <div class="card py-3">
             <div class="d-flex justify-content-between align-items-center" style="padding:15px">
                <h3 class="card-title pl-3">Manage Client</h3>
                <a href="{{ route('client.add') }}" class="btn btn-primary btn-sm">Add Client</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Action</th>
                    <th>Building</th>
                    <th>Room</th>
                    <th>Amount</th>
                    <th>Phone</th>
                    <th>Card_No</th>
                    <th>Package</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  @php
                $i = 1;
              @endphp
              <tbody>
                @foreach($clients as $client)
                  <tr>
                   
                    
                    
                    <td>
                            @php
					$ttt=date("Y-m");
					$tyty=$client->paymentdate;
					$trtr=substr($tyty,0,7);
					@endphp
					

                        @if($trtr == $ttt)
                          <button class="btn btn-sm btn-success mt-2">Paid</button>
                        @else
							<a href="" class="btn btn-sm btn-danger mt-2" data-toggle="modal" data-target="#viewModalh{{ $client->id }}">Due</a>

                        <!-- Edit building Modal -->
                        <div class="modal fade" id="viewModalh{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                    <input type="text" name="buildingname" class="form-control" id="buildingname" value="{{ $client->building->name ?? 'No Building'}}" placeholder="Name" style="background:transparent" readonly>
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
                        @endif
                        
                        @if($myadminrole=='27')
                      <a href="{{ route('client.delete',['id'=>$client->id]) }}"  class="btn btn-sm btn-danger mt-2" data-toggle="modal" data-target="#deleted-modal{{ $client->id }}"><i class="fas fa-trash"></i></a>
                      @else
                        
			          @endif

                      <!-- start Delete modal -->
                      <div class="modal fade" id="deleted-modal{{ $client->id }}">
                        <div class="modal-dialog">
                          <div class="modal-content bg-primary">
                            <div class="modal-header">
                              <h4 class="modal-title">Delete Client</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body bg-light">
                              <p>Are you sure Client Permanently Deleted?</p>
                            </div>
                            <div class="modal-footer justify-content-between bg-light">
                              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                              <a type="button" href="{{ route('client.delete',['id'=>$client->id]) }}" class="btn btn-primary"><i style="margin-right: 5px; color: white;" class="fas fa-trash"></i><span class="text-light">OK</span></a>
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                      </div>
                    
                    </td><td>{{ $client->building->name ?? 'No Building Name'}}</td>
                     <td>{{ $client->flat_no }}</td> 
                    
                     <td>{{ $client->package->package_amount ?? 'No Package'}}</td>
                   	<style>
						    #room_btn{
						      background-color: #4CAF50; /* Green */
                              color: white;
                              padding: 4px 18px;
                              width:33%;
                              text-align: center;
                              text-decoration: none;
                              display: inline-block;
                              font-size: 16px;
                              margin: 12px;
						    }
						</style>
                   
                 
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->card_no }}</td>
                    <td>{{ $client->package->package_name ?? 'No Package'}}</td>
                  
                    <td>
                    @if($myadminrole=='27')
                        <a href="{{ route('client.edit',$client->id) }}" class="btn btn-sm btn-primary mt-2"><i class="fas fa-edit"></i></a>
                      @else
                        
			          @endif
                         
                    
                      <!-- Edit Package Modal -->
                      <div class="modal fade" id="viewModal{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-danger">
                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Client</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('client.update',['id'=>$client->id] )}}" method="post">
                                @csrf

                                <div class="form-group">
                                  @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                  <input type="number" name="amount" class="form-control" id="amount" value="{{ $client->amount }}" placeholder="Amount">
                                </div>

                                <div class="form-group">
                                  @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                  <input type="text" name="description" class="form-control" id="description" value="{{ $client->description }}" placeholder="Description">
                                </div>

                                <div class="form-group float-right" >
                                  <input type="submit" class="btn btn-primary" value="Update Client">
                                </div>
                              </form>

                            </div>
                          </div>
                        </div>
                      </div>
                      
                         <a   href="{{ route('client.show',['id'=>$client->id]) }}"  class="btn btn-sm btn-info mt-2"><i class="fas fa-eye"></i></a>
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