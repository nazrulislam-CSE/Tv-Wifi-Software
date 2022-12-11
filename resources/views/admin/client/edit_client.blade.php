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
                                <h3 class="card-title">Edit Client</h3>
                                <a href="{{ route('client.all') }}" class="btn btn-primary">Go Back to Client List</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-12 col-lg-8 offset-lg-2 col-md-8 offset-md-2">
                                    <form action="{{ route('client.update',['id'=>$client->id] )}}" method="post">
                                      @csrf
                                        <div class="card-body">

                                          <div class="form-group">
                                              @error('building')
                                                  <span class="text-danger">{{ $message }}</span>
                                              @enderror
                                              <select class="custom-select" name="building_id" id="inputGroupSelect04">
                                                <option selected>Choose Building</option>
                                                @foreach($buildings as $building)
                                                  <option value="{{ $building->id }}" {{$building->id == $client->building_id ? 'selected': ''}}>{{ $building->name }}</option>
                                                @endforeach
                                              </select> 
                                            </div>

                                            <div class="form-group">
                                                @error('package')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <select class="custom-select" name="package_id" id="inputGroupSelect04">
                                                  <option selected>Choose Package</option>
                                                  @foreach($packages as $package)
                                                    <option value="{{ $package->id }}" {{$package->id == $client->package_id ? 'selected': ''}}>{{ $package->package_name }}</option>
                                                  @endforeach
                                                </select>   
                                            </div>
                                            
                                            <div class="form-group">
                                                @error('flat_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <input type="text" value="{{ $client->flat_no }}" name="flat_no" class="form-control" id="room" placeholder="Enter Flat No (Room)">
                                            </div>

                                             <div class="form-group">
                                                @error('card_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <input type="text" value="{{ $client->card_no }}" name="card_no" class="form-control" id="email" placeholder="Enter Card No" >
                                            </div>

                                            <div class="form-group">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <input type="number" value="{{ $client->phone }}" name="phone" class="form-control" id="number" placeholder="Enter Phone No" >
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-sm">Update Client</button>
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


</div>
<!-- /.content-wrapper -->
 <footer class="main-footer">
   <strong style="color:#03228f;">&copy; <?php echo date('Y'); ?> All Rights Reserved.</strong>
   <div class="float-right d-none d-sm-inline-block">
       <strong style="color:#0e73e4;" id="by">Developed by <a  href="#">Nazrul Islam</a></strong>
   </div>
</footer>
@endsection