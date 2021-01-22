@extends('front-end.layout')
@section('title','About Us')
@section('content')

<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>About us</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">About us</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Utility::description_settings('about_us') ? Utility::description_settings('about_us')->settings_value : ''; !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
@endsection
