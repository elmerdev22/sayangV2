@extends('front-end.partner.layouts.layout')
@section('title','Orders & Receipts')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Orders & Receipts',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Orders & Receipts'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-sayang mb-3">
                <div class="card-header">
                    <h5 class="card-title">Orders & Receipts</h5> 
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
                                         Buyer Name 
                                     </th>
                                     <th class="table-sort">
                                         Purchase Date
                                     </th>
                                     <th class="table-sort">
                                         Status 
                                     </th>
                                     <th class="text-center">Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @for($x=1; $x<=10; $x++)
                                     <tr>
                                         <td>0000012345</td>
                                         <td>Juan Dela Cruz</td>
                                         <td>{{date('F/d/Y')}}</td>
                                         <td>
                                             <span class="badge badge-warning">Payment Done</span>
                                         </td>
                                         <td>
                                            <a href="{{route('front-end.partner.order-and-receipt.track', ['id' => '0000012345'])}}" class="btn btn-sm btn-flat btn-warning" title="View Details"><i class="fas fa-eye"></i></a>
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