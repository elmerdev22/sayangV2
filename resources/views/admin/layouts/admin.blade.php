@extends('admin.layouts.app')
@section('title')
    Admin CMS
@endsection
@section('content')
    <div class="wrapper">
        @include('admin.layouts.navbar')
        @include('admin.layouts.sidebar')
        <div class="content-wrapper px-4 py-2">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @yield('header')
                        </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumbs')
                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('view')
                </div>
            </section>
            <!--- End of Main content -->
        </div>
    </div>
@endsection