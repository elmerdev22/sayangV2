@extends('front-end.partner.layouts.layout')
@section('title','Activities')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Activities',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Activities'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        @livewire('front-end.partner.my-products.activities.active.index')
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-sayang mb-3">
            <div class="card-header">
                <h5 class="card-title">Past Sales</h5> 
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- NOTE: Always put the show entries & search before the .table-responsive class -->
                 @include('back-end.layouts.includes.datatables.search')
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap">
                        <thead>
                            <tr>
                                <th class="table-sort">
                                    Purchase ID 
                                </th>
                                <th class="table-sort">
                                    User
                                </th>
                                <th class="table-sort">
                                    Item
                                </th>
                                <th class="table-sort">
                                    Quantity 
                                </th>
                                <th class="table-sort">
                                    Price 
                                </th>
                                <th class="table-sort">
                                    Total 
                                </th>
                                <th class="table-sort">
                                    Sold Date 
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($x=1; $x<=10; $x++)
                                <tr>
                                    <td>{{rand(100000,999999)}}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="text-blue" title="View User's Profile">{{rand(100000,999999)}}</a>
                                    </td>
                                    <td>{{rand(100000,999999)}}</td>
                                    <td>{{number_format(rand(1,1500), 0)}}</td>
                                    <td>&#x20B1; {{number_format(rand(1,1500), 2)}}</td>
                                    <td>&#x20B1; {{number_format(rand(1,1500), 2)}}</td>
                                    <td>{{date('F/d/Y')}}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-flat btn-warning" title="View Details"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                 <!-- NOTE: Always put the pagination after the .table-responsive class -->
                 {{-- @include('back-end.layouts.includes.datatables.pagination', ['pagination_items' => $data]) --}}
            </div>
        </div> <!-- card.// -->
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-sayang mb-3">
            <div class="card-header">
                <h5 class="card-title">Cancelled Sales</h5> 
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- NOTE: Always put the show entries & search before the .table-responsive class -->
                 @include('back-end.layouts.includes.datatables.search')
                 <div class="table-responsive mt-3">
                     <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap">
                         <thead>
                             <tr>
                                 <th class="table-sort">
                                     Item
                                 </th>
                                 <th class="table-sort">
                                     Quantity 
                                 </th>
                                 <th class="table-sort">
                                     Price 
                                 </th>
                                 <th class="table-sort">
                                     Posted Date 
                                 </th>
                                 <th class="table-sort">
                                     Cancelled Date 
                                 </th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             @for($x=1; $x<=10; $x++)
                                 <tr>
                                     <td>Product name</td>
                                     <td>{{rand(1000,0)}}</td>
                                     <td>{{number_format(rand(1000,9999),2)}}</td>
                                     <td>{{date('F/d/Y')}}</td>
                                     <td>{{date('F/d/Y')}}</td>
                                     <td class="text-center">
                                         <a href="javascript:void(0);" class="btn btn-sm btn-flat btn-warning" title="View Details"><i class="fas fa-eye"></i></a>
                                     </td>
                                 </tr>
                             @endfor
                         </tbody>
                     </table>
                 </div>
                 <!-- NOTE: Always put the pagination after the .table-responsive class -->
                 {{-- @include('back-end.layouts.includes.datatables.pagination', ['pagination_items' => $data]) --}}
            </div>
        </div> <!-- card.// -->
    </div>
</div>

@endsection
@section('js')
<script type="text/javascript">

</script>
@endsection