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
                <h3 class="card-title pl-3">Manage Complan</h3>

                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Action</th>
                    <th>Description</th>
                  </tr>
                  </thead>
                  @php
              $i = 1;
              @endphp
              <tbody>
                @foreach($complans as $complan)
                  <tr>
                      <td>{{ $i++ }}</td>
                      <td>
                        <a href="{{ route('edit.complan',$complan->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                    
                        
                        <a href="{{ route('delete.complan',$complan->id)}}"  class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleted-modal{{ $complan->id }}"><i class="fas fa-trash"></i></a>
                        
                        <!-- start Delete modal -->
                        <div class="modal fade" id="deleted-modal{{ $complan->id}}">
                          <div class="modal-dialog">
                            <div class="modal-content bg-primary">
                              <div class="modal-header">
                                <h4 class="modal-title">Delete Complan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body bg-light">
                                <p>Are you sure Complan Permanently Deleted?</p>
                              </div>
                              <div class="modal-footer justify-content-between bg-light">
                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                <a type="button" href="{{ route('delete.complan',['id'=>$complan->id]) }}" class="btn btn-primary"><i style="margin-right: 5px; color: white;" class="fas  fa-trash"></i><span class="text-light">OK</span></a>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                        </div>

                        
                      </td>
                      <td>{{ $complan->description }}</td>
                     
            
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

<!-- /.content-wrapper -->
 <footer class="main-footer">
   <strong style="color:#03228f;">&copy; <?php echo date('Y'); ?> All Rights Reserved.</strong>
   <div class="float-right d-none d-sm-inline-block">
       <strong style="color:#0e73e4;" id="by">Developed by <a  href="#">Nazrul Islam</a></strong>
   </div>
</footer>
@endsection