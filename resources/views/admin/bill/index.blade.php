@extends('layouts.app2')
@section('content')
<div class="content-wrapper">
    
    <!-- Main content -->
  <div class="content">
    <div class="container-fluied">
	<form action="{{ url('bill-daterange') }}" method="get">          
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
           <div class="card py-3">
               <div class="d-flex justify-content-between align-items-center" style="padding:5px">
                <h3 class="card-title pl-3">Manage Bill</h3>
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
                        <a href="{{ route('client.manageclient', $building->id) }}" class="btn btn-sm btn-info">View</a>
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

</div>
<!-- /.content-wrapper -->
 <footer class="main-footer">
   <strong style="color:#03228f;">&copy; <?php echo date('Y'); ?> All Rights Reserved.</strong>
   <div class="float-right d-none d-sm-inline-block">
       <strong style="color:#0e73e4;" id="by">Developed by <a  href="#">Nazrul Islam</a></strong>
   </div>
</footer>
@endsection