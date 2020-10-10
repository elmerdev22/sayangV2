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
                            <a href="{{route('front-end.partner.my-products.add-menu')}}" class="btn btn-warning float-right">Add New Menu</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @for ($i = 0; $i < 10; $i++)
                                
                            <div class="col-lg-4 col-md-6">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Product name</h3>
                        
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        Product Information
                                    </div>
                                <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        @endfor
                    </div>
                </div>
            </div> <!-- card.// -->
        </div>
    </div>
    
@endsection
@section('js')
<script type="text/javascript">

</script>
@endsection