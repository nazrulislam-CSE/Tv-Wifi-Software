@extends('layouts.app2')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
  <div class="content">
    <div class="container-fluied">
      <div class="row mt-3">
       <div class="col-12">
           <div class="card">
             <div class="d-flex justify-content-between align-items-center" style="padding:10px">
                <h5 class="card-title pl-3">
                  This Month Bill Paid: Total {{ $todaybills }} {{ config('app.currency') }} (Date Range: from @php $tt=date('Y-m-0 00:00:00'); echo $tt @endphp to @php $tt=date('Y-m-d H:i:s'); echo $tt @endphp (UTC)
                    </h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
					@if($userrole == '27')
                    <th>Action</th>
					@endif
                    <th>Building</th>
                    <th>Room</th>
                    <th>Amount</th>
                    <th>Phone</th>
                    <th>Card No</th>
                    <th>Package</th>
                    <th>Date(UTC)</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  @php
                $i = 1;
              @endphp
              <tbody>
                @foreach($clients as $client)
                  <tr>
                   	@if($userrole == '27')
                    <td>
                      <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#viewModalh{{ $client->id }}"><i class="fas fa-edit"></i></a>

                        <!-- Edit building Modal -->
                        <div class="modal fade" id="viewModalh{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Bill</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                 <form action="{{ route('client.billpaymentupdate',['id'=>$client->id] )}}" method="post">
                                @csrf

                                  <div class="form-group">
                                    @error('buildingname')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" name="buildingname" class="form-control" id="buildingname" value="{{ $client->building_id }}" placeholder="Name" style="background:transparent">
                                  </div>
                                  <div class="form-group">
                                    @error('flat_no')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" name="flat_no" class="form-control" id="flat_no" value="{{ $client->flat_no }}" placeholder="flat No" style="background:transparent">
                                  </div>
									<div class="form-group">
                                    @error('phone')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" name="phone" class="form-control" id="phone" value="{{ $client->phone }}" placeholder="Phone" style="background:transparent">
                                  </div>
                                  <div class="form-group">
                                    @error('package_name')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" name="package_name" class="form-control" id="package_name" value="{{ $client->package_id }}" placeholder="Package" style="background:transparent">
                                  </div>
								 <div class="form-group">
                                    @error('package_amount')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="number" name="package_amount" class="form-control" id="package_amount" value="{{ $client->bill_collect }}" placeholder="Amount" style="background:transparent" />
								  </div>
                                  <div class="form-group float-right" >
                                    <input type="submit" class="btn btn-primary" value="Edit Bill">
                                  </div>
                                </form>

                              </div>
                            </div>
                          </div>
                        </div>
                      
						
                      <a href="{{ route('clientbill.delete',['id'=>$client->id]) }}"  class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleted-modal{{ $client->id }}"><i class="fas fa-trash"></i></a>
                    
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
                              <a type="button" href="{{ route('clientbill.delete',['id'=>$client->id]) }}" class="btn btn-primary"><i style="margin-right: 5px; color: white;" class="fas  fa-trash"></i><span class="text-light">OK</span></a>
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                      </div>
                    </td>
					@endif
                   	<td>{{ $client->building_id }}</td>
                    <td>{{ $client->flat_no }}</td>
                    <td>{{ $client->bill_collect }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->card_no }}</td>
                    <td>{{ $client->package_id }}</td>
                    <td>{{ $client->created_at }}</td>
                    <td>
                      
                        @if($client->status == '1')
                          <button class="btn btn-success btn-sm">Paid</button>
                        @else
                          <button class="btn btn-danger btn-sm">Unpaid</button>
                        @endif
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