@extends('front-end.layout')
@section('title','Orders')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Orders',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Orders'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
          
<div class="row">
    <aside class="col-md-3">
        <!-- menu -->
        <div id="MainMenu">
            @include('front-end.includes.user.sidebar')
        </div>
    </aside> <!-- col.// -->
    <main class="col-md-9">
        
        <div class="card card-outline card-sayang mb-3">
            <div class="card-header">
                <h5 class="card-title">Orders</h5> 
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- NOTE: Always put the show entries & search before the .table-responsive class -->
                @include('back-end.layouts.includes.datatables.search')
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                       <thead>
                           <tr>
                               <th class="table-sort">
                                   Order ID 
                               </th>
                               <th class="table-sort">
                                   Seller Name
                               </th>
                               <th class="table-sort">
                                   Order Date
                               </th>
                               <th class="table-sort">
                                    status
                               </th>
                               <th class="table-sort">
                                   Qr Code
                               </th>
                               <th class="text-center">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           @for($x=1; $x<=10; $x++)
                               <tr>
                                   <td>00001234567</td>
                                   <td>Elmer Shop</td>
                                   <td>August 20, 2020</td>
                                   <td><span class="badge badge-success">Ready for pickup</span></td>
                                   <td><a class="btn btn-sm btn-outline-warning"><span class=" fas fa-qrcode"></span></a></td>
                                   <td>
                                        <a href="{{route('front-end.user.my-purchase.track', ['id' => '00001234567'])}}" class="btn btn-warning btn-sm">Track Order</a>
                                   </td>
                               </tr>
                           @endfor
                       </tbody>
                   </table>
               </div>
                 <!-- NOTE: Always put the pagination after the .table-responsive class -->
                 {{-- @include('back-end.layouts.includes.datatables.pagination', ['pagination_items' => $data]) --}}
            </div>
        </div>
    </main> <!-- col.// -->
</div>

@endsection
@section('js')

@endsection