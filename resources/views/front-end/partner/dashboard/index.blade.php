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
    @if (Auth::user()->is_blocked)
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger p-2" role="alert">
                    <small>{{Utility::error_message('blocked_partner_error')}}</small>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <p>So far, you've rescued</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="small-box bg-white">
                <div class="inner">
                    <h3 class="font-weight-normal">{{$elements['trees']}}</h3>
                    <p>Trees</p>
                </div>
                <div class="icon">
                    <i class="fas fa-seedling text-primary"></i>
                </div>
            </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
            <div class="small-box bg-white">
                <div class="inner">
                    <h3 class="font-weight-normal">{{$elements['water']}}</h3>
                    <p>gal of water</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tint text-info"></i>
                </div>
            </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
            <div class="small-box bg-white">
                <div class="inner">
                    <h3 class="font-weight-normal">{{$elements['energy']}}</h3>
                    <p>kw of energy</p>
                </div>
                <div class="icon">
                    <i class="fas fa-bolt" style="color: #ff9017"></i>
                </div>
            </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
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
                    <i class="fas fa-shopping-cart text-primary"></i>
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
                <a href="{{route('front-end.partner.activities.active')}}" class="small-box-footer">
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
                    <i class="fas fa-tag text-danger"></i>
                </div>
                <a href="{{route('front-end.partner.activities.past')}}" class="small-box-footer">
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
                <a href="{{route('front-end.partner.activities.cancelled')}}" class="small-box-footer">
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
@endsection