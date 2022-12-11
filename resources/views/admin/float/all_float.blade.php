@extends('layouts.app2')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header bg-light shadow-sm">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <div class="d-flex">
              <span class="mr-2"><a href="{{ route('dashboard')}}">Dashboard</a> <i class="fas fa-angle-right"></i></span>
              <span class="mr-2"><a href="#">Room</a> <i class="fas fa-angle-right"></i></span>
              <span class="mr-2"><a href="#">Rooms</a></span>
            </div>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
  <div class="content">
    <div class="container-fluied">
      <div class="row mt-3">
       <div class="col-12">
           <div class="card">
             <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title pl-3">Manage Room</h3>
                <span class="float-right">
                  <a  href="#" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary btn-sm">Create Room</a></span>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl No</th>
                    <th>Action</th>
                    <th>Flat No</th>
                    <th>Card No</th>
                    <th>Mobile No</th>
                    <th>Amount (Tk.)</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  @php
                $i = 1;
              @endphp
              <tbody>
                @foreach($floats as $float)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>
                      <a href="{{ route('float.edit',$float->id) }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#viewModal{{ $float->id }}">Edit</a>

                       <!-- Edit float Modal -->
                      <div class="modal fade" id="viewModal{{ $float->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-danger">
                              <h5 class="modal-title" id="exampleModalLongTitle">Edit Room</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('float.update',$float->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                  @error('float_name')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                  <input type="text" name="float_name" class="form-control" id="name" placeholder="Flat No" value="{{ $float->float_name }}">
                                </div>
                                  <div class="form-group">
                                  @error('float_name')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                  <input type="text" name="float_name" class="form-control" id="name" placeholder="Card No" value="{{ $float->float_name }}">
                                </div>
                                  <div class="form-group">
                                  @error('float_name')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                  <input type="text" name="float_name" class="form-control" id="name" placeholder="Mobile No" value="{{ $float->float_name }}">
                                </div>
                                <div class="form-group">
                                  @error('float_address')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                  <input type="text" name="float_address" class="form-control" id="amount" placeholder="Amount (TK.)" value="{{ $float->float_address }}">
                                </div>

                                <div class="form-group float-right" >
                                  <input type="submit" class="btn btn-primary" value="Update Float">
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <a href="{{ route('float.delete',['id'=>$float->id]) }}" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleted-modal{{ $float->id }}">Delete</a>
                      <!-- start Delete modal -->
                        <div class="modal fade" id="deleted-modal{{ $float->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content bg-primary">
                              <div class="modal-header">
                                <h4 class="modal-title">Delete Room</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body bg-light">
                                <p>Are you sure Room Permanently Deleted?</p>
                              </div>
                              <div class="modal-footer justify-content-between bg-light">
                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                <a type="button" href="{{ route('float.delete',['id'=>$float->id]) }}" class="btn btn-primary"><i style="margin-right: 5px; color: white;" class="fas  fa-trash"></i><span class="text-light">OK</span></a>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                        </div>
                    </td>
                    <td>{{ $float->float_name }}</td>
                    <td>{{ $float->float_address }}</td>
                    <td>{{ $float->float_address }}</td>
                    <td>{{ $float->float_address }}</td>
                    <td>
                        @if($float->status == 1)
                          <a href="{{ route('float.in_active',['id'=>$float->id]) }}" class="btn btn-success btn-sm">Active</a>
                        @else
                          <a href="{{ route('float.active',['id'=>$float->id]) }}" class="btn btn-danger btn-sm">Inactive</a>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Add Room</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('float.store')}}" method="post">
        @csrf
          <div class="form-group">
            @error('float_name')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" name="float_name" class="form-control" id="name" placeholder="Flat No" value="">
          </div>
          <div class="form-group">
            @error('float_name')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" name="float_name" class="form-control" id="name" placeholder="Card No" value="">
          </div>
            <div class="form-group">
            @error('float_name')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" name="float_name" class="form-control" id="name" placeholder="Mobile No" value="">
          </div>
          <div class="form-group">
            @error('float_address')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" name="float_address" class="form-control" id="amount" placeholder="Amount (TK.)" value="">
          </div>

          <div class="form-group float-right" >
            <input type="submit" class="btn btn-primary" value="Update Float">
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