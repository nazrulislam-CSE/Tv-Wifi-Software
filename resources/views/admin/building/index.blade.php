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
                <h3 class="card-title pl-3">Manage Building</h3>
                <span class="float-right" style="padding:15px">
                  <a  href="#" data-toggle="modal" data-target="#exampleModalCenterrr" class="btn btn-primary btn-sm">Create Building</a></span>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Action</th>
                    <th>Building</th>
                    <th>Number</th>
                    <th>Address</th>
                  </tr>
                  </thead>
                  @php
              $i = 1;
              @endphp
              <tbody>
                @foreach($buildings as $building)
                  <tr>
                      <td>{{ $i++ }}</td>
                      <td>
                        <a href="{{ route('building.edit',$building->id) }}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#viewModal{{ $building->id }}"><i class="fas fa-edit"></i></a>

                        <!-- Edit building Modal -->
                        <div class="modal fade" id="viewModal{{ $building->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Building</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="{{ route('building.update',['id'=>$building->id] )}}" method="post">
                                  @csrf
                                  <div class="form-group">
                                    @error('name')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $building->name }}" placeholder="Name">
                                  </div>
                                  <div class="form-group">
                                    @error('phone')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="number" name="phone" class="form-control" id="phone" value="{{ $building->phone }}" placeholder="Phone">
                                  </div>

                                  <div class="form-group">
                                    @error('address')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" name="address" class="form-control" id="address" value="{{ $building->address }}" placeholder="Address">
                                  </div>

                                  <div class="form-group float-right" >
                                    <input type="submit" class="btn btn-primary" value="Update Building">
                                  </div>
                                </form>

                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <a href="{{ route('building.delete',['id'=>$building->id]) }}"  class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleted-modal{{ $building->id }}"><i class="fas fa-trash"></i></a>
                        
                        <!-- start Delete modal -->
                        <div class="modal fade" id="deleted-modal{{ $building->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content bg-primary">
                              <div class="modal-header">
                                <h4 class="modal-title">Delete Building</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body bg-light">
                                <p>Are you sure Building Permanently Deleted?</p>
                              </div>
                              <div class="modal-footer justify-content-between bg-light">
                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                <a type="button" href="{{ route('building.delete',['id'=>$building->id]) }}" class="btn btn-primary"><i style="margin-right: 5px; color: white;" class="fas  fa-trash"></i><span class="text-light">OK</span></a>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                        </div>

                        
                      </td>
                      <td>{{ $building->name }}</td>
                      <td>{{ $building->phone }}</td>
                      <td>{{ $building->address }}</td>
                     
            
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

<!-- Store building Modal -->
<div class="modal fade" id="exampleModalCenterrr" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Building</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('building.store') }}" method="post">
          @csrf

          <div class="form-group">
            @error('name')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" name="name" class="form-control" id="name" placeholder="Buiding name">
          </div>
          <div class="form-group">
            @error('phone')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="number" name="phone" class="form-control" id="phone" placeholder="Phone">
          </div>
          <div class="form-group">
            @error('address')
              <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" name="address" class="form-control" id="address" placeholder="Address">
          </div>

          <div class="form-group float-right" >
            <input type="submit" class="btn btn-primary" value="Add Building">
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