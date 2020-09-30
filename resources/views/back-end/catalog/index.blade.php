@extends('back-end.layouts.layout')
@section('title','Catalogs')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Catalogs',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Catalogs'],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <!-- CONTENT HERE -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Category Name</h3>
                        </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                        <form role="form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name"  placeholder="Enter Name">
                                </div>
                            </div>
                        <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <!-- CONTENT HERE -->
            <div class="row">
                <div class="col-12 mb-2">
                    <input type="search" class="form-control" placeholder="Search Category Name...">
                </div>
                @for($x=0;$x < 10; $x++)
                <div class="col-12">
                    <div class="card card-warning collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Category name</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                </button>
                            </div>
                        <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <label>Add Subcategory</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Subcategory Name">
                                        <div class="input-group-append">
                                            <button class="btn btn-warning">
                                                <span class="fas fa-plus"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                @for($i=0;$i < 10; $i++)
                                    <div class="col-lg-4 col-md-6"><span class="fas fa-chevron-right"></span> Subcategory</div>
                                @endfor
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection
@section('js')

@endsection