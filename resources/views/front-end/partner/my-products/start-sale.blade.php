@extends('front-end.partner.layouts.layout')
@section('title','Start Sale')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Start a Sale',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Start a Sale'],
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
                <h5 class="card-title">My Products List</h5> 
                <div class="card-tools">
                    <a href="#" data-toggle="modal" data-target="#startSale" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> Proceed </a>
                    <a href="{{route('front-end.partner.my-products.index')}}" class="btn btn-danger btn-sm">Back </a>
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
                                   Category 
                               </th>
                               <th class="table-sort">
                                   Product Name
                               </th>
                               <th class="table-sort" width="150">
                                   Buy now price
                               </th>
                               <th class="table-sort" width="150">
                                   Lowest Price
                               </th>
                               <th class="table-sort" width="100">
                                   Quantity
                               </th>
                               <th class="text-center">Select</th>
                           </tr>
                       </thead>
                       <tbody>
                           @for($x=1; $x<=10; $x++)
                               <tr>
                                   <td>Foods</td>
                                   <td>Product name</td>
                                   <td><input type="text" class="form-control form-control-sm" value="{{number_format(rand(1000,9999),2)}}"></td>
                                   <td><input type="text" class="form-control form-control-sm" value="{{number_format(rand(100,999),2)}}"></td>
                                   <td><input type="number" class="form-control form-control-sm" value="{{number_format(rand(1,99))}}"></td>
                                   <td class="text-center">
                                        <div class="icheck-warning">
                                            <input type="checkbox" id="{{$x}}">
                                            <label for="{{$x}}">
                                            </label>
                                        </div>
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
<!-- Modal -->
<div class="modal fade" id="startSale" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Start Sale</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    @php $count = 3; @endphp
                    <label>Products : {{$count}} items</label>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Buy now price</th>
                                <th scope="col">Lowest price</th>
                                <th scope="col">Quantity</th>
                            </tr>
                          </thead>
                        <tbody>
                            @for($x=1; $x<=$count; $x++)
                            <tr>
                                <td>Name</td>
                                <td>{{number_format(rand(1000,9999),2)}}</td>
                                <td>{{number_format(rand(1000,9999),2)}}</td>
                                <td>{{number_format(rand(1,99))}}</td>
                            </tr>
                            @endfor
                          </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label for="price">Start Date</label>
                    <input type="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="price">End Date</label>
                    <input type="date" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Start a Sale</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    function deleteProduct(){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
        })
    }
</script>
@endsection