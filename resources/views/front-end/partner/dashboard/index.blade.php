@extends('front-end.partner.layouts.layout')
@section('title','Dashboard')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Dashboard',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Dasboard'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>{{number_format($data['order_placed'] ,0)}}</h3>
                    <p>Order Placed (COP)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart text-warning"></i>
                </div>
                <a href="{{route('front-end.partner.order-and-receipt.order-placed')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>{{number_format($data['to_receive'] ,0)}}</h3>
                    <p>To Receive/Pick-up</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart text-info"></i>
                </div>
                <a href="{{route('front-end.partner.order-and-receipt.to-receive')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>{{number_format($data['completed'] ,0)}}</h3>
                    <p>Completed Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart text-success"></i>
                </div>
                <a href="{{route('front-end.partner.order-and-receipt.completed')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>{{number_format($data['cancelled'] ,0)}}</h3>
                    <p>Cancelled Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart text-danger"></i>
                </div>
                <a href="{{route('front-end.partner.order-and-receipt.cancelled')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>{{number_format($data['total_products_active'] ,0)}}</h3>
                    <p>Active/Incoming Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tag text-warning"></i>
                </div>
                <a href="{{route('front-end.partner.my-products.activities.index')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>{{number_format($data['total_products_ended'] ,0)}}</h3>
                    <p>Ended Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tag text-success"></i>
                </div>
                <a href="{{route('front-end.partner.my-products.activities.index')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>{{number_format($data['total_products_cancelled'] ,0)}}</h3>
                    <p>Cancelled Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tag text-danger"></i>
                </div>
                <a href="{{route('front-end.partner.my-products.activities.index')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>{{number_format($data['total_followers'] ,0)}}</h3>
                    <p>Total Followers</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users text-warning"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-wrench"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <a href="#" class="dropdown-item">Action</a>
                                <a href="#" class="dropdown-item">Another action</a>
                                <a href="#" class="dropdown-item">Something else here</a>
                                <a class="dropdown-divider"></a>
                                <a href="#" class="dropdown-item">Separated link</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="text-center">
                                <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                            </p>

                            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <!-- Sales Chart Canvas -->
                                <canvas id="salesChart" height="180" style="height: 180px; display: block; width: 680px;" width="680" class="chartjs-render-monitor"></canvas>
                            </div>
                        <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <p class="text-center">
                                <strong>Goal Completion</strong>
                            </p>

                            <div class="progress-group">
                                Add Products to Cart
                                <span class="float-right"><b>160</b>/200</span>
                                <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: 80%"></div>
                                </div>
                            </div>
                        <!-- /.progress-group -->

                            <div class="progress-group">
                                Complete Purchase
                                <span class="float-right"><b>310</b>/400</span>
                                <div class="progress progress-sm">
                                <div class="progress-bar bg-danger" style="width: 75%"></div>
                                </div>
                            </div>

                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text">Visit Premium Page</span>
                                <span class="float-right"><b>480</b>/800</span>
                                <div class="progress progress-sm">
                                <div class="progress-bar bg-success" style="width: 60%"></div>
                                </div>
                            </div>

                            <!-- /.progress-group -->
                            <div class="progress-group">
                                Send Inquiries
                                <span class="float-right"><b>250</b>/500</span>
                                <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" style="width: 50%"></div>
                                </div>
                            </div>
                        <!-- /.progress-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                <!-- /.row -->
                </div>
                <!-- ./card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                                <h5 class="description-header">$35,210.43</h5>
                                <span class="description-text">TOTAL REVENUE</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                                <h5 class="description-header">$10,390.90</h5>
                                <span class="description-text">TOTAL COST</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                                <h5 class="description-header">$24,813.53</h5>
                                <span class="description-text">TOTAL PROFIT</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                                <h5 class="description-header">1200</h5>
                                <span class="description-text">GOAL COMPLETIONS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-footer -->
            </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
    </div> --}}
@endsection
@section('js')
<script src="{{ asset('template/assets/plugins/chart.js/Chart.min.js') }}"></script>
<script type="text/javascript">
$(function () {

'use strict'

/* ChartJS
 * -------
 * Here we will create a few charts using ChartJS
 */

//-----------------------
//- MONTHLY SALES CHART -
//-----------------------

// Get context with jQuery - using jQuery's .get() method.
var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

var salesChartData = {
  labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
  datasets: [
    {
      label               : 'Digital Goods',
      backgroundColor     : 'rgba(60,141,188,0.9)',
      borderColor         : 'rgba(60,141,188,0.8)',
      pointRadius          : false,
      pointColor          : '#3b8bba',
      pointStrokeColor    : 'rgba(60,141,188,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data                : [28, 48, 40, 19, 86, 27, 90]
    },
    {
      label               : 'Electronics',
      backgroundColor     : 'rgba(210, 214, 222, 1)',
      borderColor         : 'rgba(210, 214, 222, 1)',
      pointRadius         : false,
      pointColor          : 'rgba(210, 214, 222, 1)',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : [65, 59, 80, 81, 56, 55, 40]
    },
  ]
}

var salesChartOptions = {
  maintainAspectRatio : false,
  responsive : true,
  legend: {
    display: false
  },
  scales: {
    xAxes: [{
      gridLines : {
        display : false,
      }
    }],
    yAxes: [{
      gridLines : {
        display : false,
      }
    }]
  }
}

// This will get the first returned node in the jQuery collection.
var salesChart = new Chart(salesChartCanvas, { 
    type: 'line', 
    data: salesChartData, 
    options: salesChartOptions
  }
)

//---------------------------
//- END MONTHLY SALES CHART -
//---------------------------


})
</script>
@endsection