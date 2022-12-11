@extends('layouts.app2')
@section('content')
<div class="content-wrapper">
  
    <!-- Main content -->
    <div class="content mt-3">
        <div class="container-fluied">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card py-3">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center" style="padding:5px">
                                <h3 class="card-title">Edit Complan</h3>
                                <a href="{{ route('list.complan')}}" class="btn btn-primary">Go Back to Complan List</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-12 col-lg-8 offset-lg-2 col-md-8 offset-md-2">
                                    <form action="{{ route('update.complan',$complans->id ) }}" method="post">
                                      @csrf
                                        <div class="card-body">

                                          <div class="form-group">
                                             @error('description')
												<span class="text-danger">{{            $message }}</span>
											 @enderror()
											
                                          <textarea id="short_description" name="description" class="form-control" rows="8" cols="20" placeholder="please some text here">
                                              {{ $complans->description }}
                                              </textarea>
                                              </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Update Complan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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