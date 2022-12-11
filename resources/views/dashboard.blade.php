@extends('layouts.app2')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header bg-light shadow-sm">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div>
              <span class="mr-2"><a target="_blank" href="{{ route('dashboard') }}">Dashboard</a></span>
            </div>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content mt-3">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
		
		 <style>.kkwwdd{font-size: 14px}</style>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $todaybills }} <sup class="kkwwdd">{{ config('app.currency') }}</sup></h3>

                <p>Todays Bill Paid</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ url('todaybill') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->   
		
		 <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $thismnthbills }} <sup class="kkwwdd">{{ config('app.currency') }}</sup></h3>

                <p>This Month Bill Paid</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ url('monthbill') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col --> 
		  
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $todaycosts }} <sup class="kkwwdd">{{ config('app.currency') }}</sup></h3>

                <p>Todays Cost</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
			   <a href="{{ url('todaycost') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
             
             </div>
          </div>
          <!-- ./col -->   
		  
		 <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $thismnthcosts }} <sup class="kkwwdd">{{ config('app.currency') }}</sup></h3>

                <p>This Month Cost</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
			   <a href="{{ url('monthcost') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
             
             </div>
          </div>
          <!-- ./col --> 
		  
		 @if($myadminrole=='27')
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $todaycashs }} <sup class="kkwwdd">{{ config('app.currency') }}</sup></h3>

                <p>Todays Cash</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ url('todaycash') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->   
	
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $thismnthcashs }} <sup class="kkwwdd">{{ config('app.currency') }}</sup></h3>

                <p>This Month Cash</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ url('monthcash') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->    
		  @endif
		  
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $packages }}</h3>

                <p>Total Packages</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
               @if($myadminrole=='27')
				   <a href="{{ url('package') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
             @else
				  <a href="{{ url('bill-all') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			  @endif
			</div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $buildings }}</h3>

                <p>Total Buildings</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
			  
			  @if($myadminrole=='27')
              <a href="{{ url('building-all') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
             @else
				  <a href="{{ url('bill-all') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			  @endif
			</div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $clients }}</h3>

                <p>Total Clients</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
			  @if($myadminrole=='27')
              <a href="{{ url('client-all') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @else
				  <a href="{{ url('client-all') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			  @endif
			  
			</div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $tttdue }} <sup class="kkwwdd">{{ config('app.currency') }}</sup></h3>

                <p>Total Due</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
			 @if($myadminrole=='27')
              <a href="{{ url('client-all') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
             @else
				  <a href="{{ url('client-all') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			  @endif
			</div>
          </div>
          <!-- ./col -->
       
		   
		   
        </div>
		<!-- end row -->
		
	
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
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