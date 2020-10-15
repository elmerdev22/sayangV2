@extends('front-end.partner.layouts.layout')
@section('title','Products List')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'My Products',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'My Products'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    {{-- <div class="row">
        <div class="col-12">
            <div class="card card-outline card-sayang mb-3">
                <div class="card-header">
                    <h5 class="card-title">My Menu List</h5> 
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6 mb-2">
                            <input type="search" class="form-control" placeholder="Search...">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-warning float-right" data-toggle="modal" data-target="#addCategory"><i class="fas fa-plus"></i> Menu Category</button>
                        </div>
                    </div>
                    <hr>
                    
                    @for ($x = 0; $x < 10; $x++)

                        <div class="row">
                            <div class="col-12">
                                <div class="card card-sayang collapsed-card">
                                    <div class="card-header">
                                        <h5 class="card-title">Category Name </h5> 
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" onclick="deleteMenu()"><i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row pb-3">
                                            <div class="col-md-6 mb-2">
                                                <input type="search" class="form-control" placeholder="Search...">
                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{route('front-end.partner.my-products.add-menu')}}" class="btn btn-warning float-right"><i class="fas fa-plus"></i> Product
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            
                                        @for ($i = 0; $i < 8; $i++)
                                                
                                        <div class="col-lg-3 col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Product name</h3>
                                    
                                                    <div class="card-tools">
                                                        <a href="{{route('front-end.partner.my-products.edit-menu')}}" class="btn btn-tool" data-card-widget="edit"><i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-tool" onclick="deleteMenu()"><i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <!-- /.card-tools -->
                                                </div>
                                                <img src="{{asset('images/default-photo/product1.jpg')}}" class="card-img-top" alt="...">
                                                <div class="card-footer">
                                                    <button class="btn btn-warning btn-sm w-100">Start a Sale</button>
                                                </div>
                                                <!-- /.card-header -->
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div> <!-- card.// -->
        </div>
    </div> --}}
    
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-sayang mb-3">
            <div class="card-header">
                <h5 class="card-title">My Products List</h5> 
                <div class="card-tools">
                    <a href="{{route('front-end.partner.my-products.add-product')}}" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> Product </a>
                    <a href="{{route('front-end.partner.my-products.start-sale')}}" class="btn btn-danger btn-sm"><i class="fas fa-plus"></i> Start a Sale </a>
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
                                <th class="table-sort">
                                    Buy now price
                                </th>
                                <th class="table-sort">
                                    Lowest Price
                                </th>
                                <th class="table-sort">
                                    Date Created 
                                </th>
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($x=1; $x<=10; $x++)
                                <tr>
                                    <td>Foods</td>
                                    <td>Product name</td>
                                    <td>{{number_format(rand(1000,9999),2)}}</td>
                                    <td>{{number_format(rand(100,999),2)}}</td>
                                    <td>{{date('F/d/Y')}}</td>
                                    <td class="">
                                        <a href="{{route('front-end.partner.my-products.edit-product')}}" class="btn btn-sm btn-flat btn-default" title="Edit Details"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0);" onclick="deleteProduct()" class="btn btn-sm btn-flat btn-danger" title="Delete Details"><i class="fas fa-trash"></i></a>
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