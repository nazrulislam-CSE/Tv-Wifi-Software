@extends('layouts.app2')
@section('content')
<div class="content-wrapper">
 
    <!-- Main content -->
  <div class="content">
    <div class="container-fluied">
      <div class="row mt-3">
          <div class="col-12">
           <div class="card py-3">
               <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title pl-3">Manage User</h3>
                <span class="float-right" style="padding:15px">
                  <a  href="#" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary btn-sm">Create User</a></span>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Action</th>
                    <th>Name</th>
                    <th>Email/Username</th>
                    <th>Phone</th>
                    <th>Join Date</th>
                  </tr>
                  </thead>
                  @php
                  $i = 1;
                  @endphp
                  <tbody>
                    @foreach($customers as $customer)
                      <tr>
                          <td>{{ $i++ }}</td>

                          <td>
                            <a href="{{ route('customer.edit',$customer->id) }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#viewModal{{ $customer->id }}"><i class="fas fa-edit"></i></a>

                            <!-- Edit Package Modal -->
                            <div class="modal fade" id="viewModal{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header bg-danger">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="{{ route('customer.update',['id'=>$customer->id] )}}" method="post">
                                      @csrf

                                      <div class="form-group">
                                        @error('user_name')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <input type="text" name="user_name" class="form-control" required="" id="user_name" value="{{ $customer->email }}" placeholder="Email/Username">
                                      </div>

                                      <div class="form-group">
                                        @error('name')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <input type="text" name="name" class="form-control" required="" id="name" value="{{ $customer->name }}" placeholder="Name">
                                      </div>

                                      <div class="form-group">
                                        @error('phone')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <input type="text" name="phone" class="form-control" required="" id="phone" value="{{ $customer->phone }}" placeholder="Phone">
                                      </div>

                                      <div class="form-group">
                                        @error('password')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <input type="password" name="password" class="form-control" required="" id="password" value="" placeholder="Edit Password">
                                      </div>

                                      <div class="form-group float-right" >
                                        <input type="submit" class="btn btn-primary" value="Update User">
                                      </div>
                                    </form>

                                  </div>
                                </div>
                              </div>
                            </div>

                            <a href="{{ route('customer.delete',['id'=>$customer->id]) }}"  class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleted-modal{{ $customer->id }}"><i class="fas fa-trash"></i></a>

                            <!-- start Delete modal -->
                            <div class="modal fade" id="deleted-modal{{ $customer->id }}">
                              <div class="modal-dialog">
                                <div class="modal-content bg-primary">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Delete User</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body bg-light">
                                    <p>Are you sure User Permanently Deleted?</p>
                                  </div>
                                  <div class="modal-footer justify-content-between bg-light">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                    <a type="button" href="{{ route('customer.delete',['id'=>$customer->id]) }}" class="btn btn-primary"><i style="margin-right: 5px; color: white;" class="fas  fa-trash"></i><span class="text-light">OK</span></a>
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                            </div>
                          </td>
                          <td>{{ $customer->name }}</td>
                          <td>{{ $customer->email }}</td>
                          <td>{{ $customer->phone }}</td>
                          <td>{{ $customer->created_at }}</td>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('customer.store') }}" method="post">
          @csrf


          <div class="form-group">
            @error('user_name')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" name="user_name" class="form-control" required="" id="user_name" placeholder="Email/Usename">
          </div>

          <div class="form-group">
            @error('name')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" name="name" class="form-control" required="" id="name" placeholder="Name">
          </div>

          <div class="form-group">
            @error('phone')
			  <span class="text-danger">{{ $message }}</span>
			@enderror
			<input type="text" name="phone" class="form-control" required="" id="phone" placeholder="Phone">
		  </div>

          <div class="form-group">
            @error('password')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="password" name="password" class="form-control" required="" id="password" placeholder="Password">
          </div>

          <div class="form-group float-right" >
            <input type="submit" class="btn btn-primary" value="Add User">
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