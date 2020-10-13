@extends('front-end.partner.layouts.layout')
@section('title','QR Code')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'My Menu',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'My Menu'],
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
                                            
                                        @for ($i = 0; $i < 10; $i++)
                                                
                                        <div class="col-lg-3 col-md-6">
                                            <div class="card">
                                                <img src="{{asset('images/default-photo/product1.jpg')}}" class="card-img-top" alt="...">
                                                
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
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Menu Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <select class="form-control">
                            <option>Category Name</option>
                            <option>Category Name</option>
                            <option>Category Name</option>
                            <option>Category Name</option>
                            <option>Category Name</option>
                        </select>    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script type="text/javascript">
    function deleteMenu(){
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