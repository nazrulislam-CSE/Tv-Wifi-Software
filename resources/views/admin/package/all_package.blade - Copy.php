@extends('layouts.app2')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- Main content -->
  <div class="content">
    <div class="container-fluied">
      <div class="row mt-3">
        	<div class="col-12">
           <div class="card">
               <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title pl-3">Manage Package</h3>
                <span class="float-right" style="padding:15px">
                  <a  href="#" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary btn-sm">Create Package</a></span>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Action</th>
                    <th>Package Name</th>
                    <th>Package Price</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  @php
              $i = 1;
              @endphp
              <tbody>
                @foreach($packages as $package)
                  <tr>
                      <td>{{ $i++ }}</td>
                      <td>
                          <a href="{{ route('package.edit',$package->id) }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#viewModal{{ $package->id }}">Edit</a>

                          <!-- Edit Package Modal -->
                          <div class="modal fade" id="viewModal{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-danger">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Edit Package</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form action="{{ route('package.update',['id'=>$package->id] )}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                      <label for="name">Package Name</label>
                                      @error('package_name')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                      <input type="text" name="package_name" class="form-control" id="name" value="{{ $package->package_name }}" placeholder="Package Name">
                                    </div>

                                    <div class="form-group">
                                      @error('package_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                      <input type="text" name="package_amount" class="form-control" id="amount" value="{{ $package->package_amount }}" placeholder="Package Amount">
                                    </div>

                                    <div class="form-group float-right" >
                                      <input type="submit" class="btn btn-primary" value="Update Package">
                                    </div>
                                  </form>

                                </div>
                              </div>
                            </div>
                          </div>

                          <a href="{{ route('package.delete',['id'=>$package->id]) }}"  class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleted-modal{{ $package->id }}">Delete</a>

                          <!-- start Delete modal -->
                          <div class="modal fade" id="deleted-modal{{ $package->id }}">
                            <div class="modal-dialog">
                              <div class="modal-content bg-primary">
                                <div class="modal-header">
                                  <h4 class="modal-title">Delete Package</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body bg-light">
                                  <p>Are you sure Package Permanently Deleted?</p>
                                </div>
                                <div class="modal-footer justify-content-between bg-light">
                                  <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                  <a type="button" href="{{ route('package.delete',['id'=>$package->id]) }}" class="btn btn-primary"><i style="margin-right: 5px; color: white;" class="fas  fa-trash"></i><span class="text-light">OK</span></a>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                          </div>
                      </td>
                      <td>{{ $package->package_name }}</td>
                      <td>{{ $package->package_amount }}</td>
                      <td>
                        @if($package->status == 1)
                          <a href="{{ route('package.in_active',['id'=>$package->id]) }}" class="btn btn-success btn-sm">Active</a>
                        @else
                          <a href="{{ route('package.active',['id'=>$package->id]) }}" class="btn btn-danger btn-sm">Inactive</a>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Add Package</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('package.store') }}" method="post">
        	@csrf

          <div class="form-group">
            @error('package_name')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" name="package_name" class="form-control" id="name" placeholder="Name">
          </div>

        	<div class="form-group">
        		@error('package_amount')
        			<span class="text-danger">{{ $message }}</span>
        		@enderror
        		<input type="text" name="package_amount" class="form-control" id="amount" placeholder="Amount {{config('app.currency')}}">
        	</div>

        	<div class="form-group float-right" >
        		<input type="submit" class="btn btn-primary" value="Add Package">
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