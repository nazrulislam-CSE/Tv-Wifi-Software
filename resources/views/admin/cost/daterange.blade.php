@extends('layouts.app2')
@section('content')
<div class="content-wrapper">
 
    <!-- Main content -->
  <div class="content">
    <div class="container-fluied">
	<form action="{{ url('cost-daterange') }}" method="get">          
		  @csrf
		  @method('GET')
		 <div class="row" style="padding-top:15px">
		 
           
            <div class="col-sm-2"></div>			
		 <div class="col-sm-3 col-5">
             <div class="form-group">
              <label for="">Start Date</label>
              <input type="date" class="form-control" name="start_date" required="" />
            </div>
          </div>
          <div class="col-sm-3 col-4">
            <div class="form-group">
              <label for="">End Date</label>
              <input type="date" class="form-control" name="end_date" required="" />
            </div>
          </div>
		 
		  <div class="col-sm-2 col-3" style="margin-top: 33px;">
				<div class="form-group">
					<input type="submit" class="btn btn-info" value="Search">
                </div>
          </div>
        </div>
		
		  </form>
	
      <div class="row mt-3">
          <div class="col-12">
           <div class="card">
               <div class="d-flex justify-content-between align-items-center">
                 <h6 class="pl-3">Date Range: From {{ $startDate }} to {{ $endDate }} & Total Cash: {{ $tcashs }} {{ config('app.currency') }}</h6>
               
                <span class="float-right" style="padding:15px">
                  <a  href="#" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary btn-sm">Create Cost</a></span>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Action</th>
                    <th>Date</th>
                    <th>Amount ({{ config('app.currency') }})</th>
                    <th>Description</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  @php
              $i = 1;
              @endphp
              <tbody>
                @foreach($costs as $cost)
                  <tr>
                      <td>{{ $i++ }}</td>

                      <td>
                        <a href="{{ route('cost.edit',$cost->id) }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#viewModal{{ $cost->id }}">Edit</a>

                        <!-- Edit Package Modal -->
                        <div class="modal fade" id="viewModal{{ $cost->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Cost</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="{{ route('cost.update',['id'=>$cost->id] )}}" method="post">
                                  @csrf

                                  <div class="form-group">
                                    @error('amount')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="number" name="amount" class="form-control" id="amount" value="{{ $cost->amount }}" placeholder="Amount">
                                  </div>

                                  <div class="form-group">
                                    @error('description')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" name="description" class="form-control" id="description" value="{{ $cost->description }}" placeholder="Description">
                                  </div>

                                  <div class="form-group float-right" >
                                    <input type="submit" class="btn btn-primary" value="Update Cash">
                                  </div>
                                </form>

                              </div>
                            </div>
                          </div>
                        </div>

                        <a href="{{ route('cost.delete',['id'=>$cost->id]) }}"  class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleted-modal{{ $cost->id }}">Delete</a>

                        <!-- start Delete modal -->
                        <div class="modal fade" id="deleted-modal{{ $cost->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content bg-primary">
                              <div class="modal-header">
                                <h4 class="modal-title">Delete Cash</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body bg-light">
                                <p>Are you sure Cash Permanently Deleted?</p>
                              </div>
                              <div class="modal-footer justify-content-between bg-light">
                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                <a type="button" href="{{ route('cost.delete',['id'=>$cost->id]) }}" class="btn btn-primary"><i style="margin-right: 5px; color: white;" class="fas  fa-trash"></i><span class="text-light">OK</span></a>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                        </div>
                      </td>

                      <td>{{ $cost->created_at }}</td>
                      <td>{{ $cost->amount }}</td>
                      <td>{{ $cost->description }}</td>
                      <td>
                        @if($cost->status == 1)
                          <a href="{{ route('cost.in_active',['id'=>$cost->id]) }}" class="btn btn-success btn-sm">Active</a>
                        @else
                          <a href="{{ route('cost.active',['id'=>$cost->id]) }}" class="btn btn-danger btn-sm">Inactive</a>
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

<!-- Store Package Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Cost</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('cost.store') }}" method="post">
          @csrf


          <div class="form-group">
            @error('amount')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="number" name="amount" class="form-control" id="amount" placeholder="Amount {{config('app.currency')}}">
          </div>

          <div class="form-group">
            @error('description')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" name="description" class="form-control" id="description" placeholder="Description">
          </div>

          <div class="form-group float-right" >
            <input type="submit" class="btn btn-primary" value="Add Cash">
          </div>
        </form>

      </div>
    </div>
  </div>
</div>


</div>
<!-- /.content-wrapper -->
  <footer class="main-footer">
   <strong style="color:#03228f;">&copy; <?php echo date('Y'); ?> All Rights Reserved.</strong>
   <div class="float-right d-none d-sm-inline-block">
       <strong style="color:#0e73e4;" id="by">Developed by <a  href="#">Nazrul Islam</a></strong>
   </div>
</footer>
@endsection