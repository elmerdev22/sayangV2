@extends('front-end.partner.layouts.layout')
@section('title','Edit Products')
@section('css')
<link rel="stylesheet" href="{{asset('template/assets/plugins/select2/css/select2.min.css')}}"> 
<link rel="stylesheet" href="{{asset('template/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"> 
@endsection
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Edit Menu',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Edit Menu'],
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
                    <h5 class="card-title">Edit Product Requirement</h5> 
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-2">
                            <div class="col-12">
                                <h4>Product Details</h4>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" placeholder="Product Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control catalog" style="width: 100%;">
                                        <option selected="selected">Select</option>
                                        <option>Category</option>
                                        <option>Category</option>
                                        <option>Category</option>
                                        <option>Category</option>
                                        <option>Category</option>
                                        <option>Category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sub Category</label>
                                    <select class="form-control catalog" style="width: 100%;">
                                        <option selected="selected">Select</option>
                                        <option>Sub Category</option>
                                        <option>Sub Category</option>
                                        <option>Sub Category</option>
                                        <option>Sub Category</option>
                                        <option>Sub Category</option>
                                        <option>Sub Category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tags</label>
                                    <select class="form-control tags" multiple style="width: 100%;">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Buy now price</label>
                                    <input type="text" class="form-control" placeholder="Buy now Price Here">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Lowest price</label>
                                    <input type="text" class="form-control" placeholder="Lowest Price Here">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" placeholder="Description here..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Few Reminders</label>
                                    <textarea class="form-control" placeholder="Reminders here..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <h4>Product Photos</h4>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Featured Photo</h5> 
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-warning btn-sm"><i class="fas fa-upload"></i> Upload Photo
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{asset('images/default-photo/product1.jpg')}}" class="card-img-top" alt="...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Other Photos</h5> 
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-warning btn-sm"><i class="fas fa-upload"></i> Upload Photo
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @for ($a = 0; $a < 6; $a++)
                                                    <div class="col-lg-4 col-sm-6">
                                                        <div class="card">
                                                            <img src="{{asset('images/default-photo/product1.jpg')}}" class="card-img-top" alt="...">
                                                            <div class="card-footer text-center">
                                                                <button class="btn btn-danger btn-sm">Remove</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-warning float-right w-100">Add this Product</button>
                </div>
            </div> <!-- card.// -->
        </div>
    </div>
    
@endsection
@section('js')
<script src="{{asset('template/assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        //Initialize Select2 Elements
        $('.catalog').select2({
            theme: 'bootstrap4'
        })
        $('.tags').select2({
            tags: true,
            placeholder: "Input Tags",
            tokenSeparators: [',', ' '],
            "language":{
            "noResults" : function () { return ''; }
            },
        })
        
    })
</script>
@endsection