@extends('front-end.layout')
@section('title','Terms and Conditions (Users)')
@section('content')

<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Terms and Conditions <small>(Users)</small></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Terms and Conditions</li>
                    <li class="breadcrumb-item active">Users</li>
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
                        {!! Utility::description_settings('terms_and_conditions_users') ? Utility::description_settings('terms_and_conditions_users')->settings_value : ''; !!}
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
@endsection
