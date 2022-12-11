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
		 <div class="col-sm-3 col-6">
             <div class="form-group">
              <label for="">Start Date</label>
              <input type="date" class="form-control" name="start_date" required="" />
            </div>
          </div>
          <div class="col-sm-3 col-6">
            <div class="form-group">
              <label for="">End Date</label>
              <input type="date" class="form-control" name="end_date" required="" />
            </div>
          </div>
		  
		  <div class="col-sm-2 col-6" style="margin-top: 33px;">
				<div class="form-group">
					<input type="submit" class="btn btn-info" value="Search">
                </div>
          </div>
        </div>
		</form>
	
	
      <div class="row mt-3">
        	<div class="col-12">
           <div class="card py-3">
               <div class="d-flex justify-content-between align-items-center">
                <h6 class="pl-3">Date Range: From {{ $startDate }} to {{ $endDate }} & Total Cash: {{ $tcashs }} {{ config('app.currency') }}</h6>
                <span class="float-right" style="padding:15px">
                  <a  href="#" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary btn-sm">Create Cash</a></span>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Date</th>
                    <th>Amount ({{ config('app.currency') }})</th>
                    <th>Room</th>
					<th>Building</th>
                  </tr>
                  </thead>
                  @php
              $i = 1;
              @endphp
              <tbody>
                @foreach($cashs as $cash)
                  <tr>
                      <td>{{ $i++ }}</td>

                      <td>{{ $cash->created_at }}</td>
                      <td>{{ $cash->bill_collect }}</td>
                      <td>{{ $cash->flat_no }}</td>
                      <td>{{ $cash->building_id }}</td>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Add Cash</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('cash.store') }}" method="post">
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