@extends('front-end.layout')
@section('title','Terms and Conditions (Partners)')
@section('content')

<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Terms and Conditions <small>(Partners)</small></h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Terms and Conditions</li>
                    <li class="breadcrumb-item active">Partners</li>
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
                                {!! Utility::description_settings('terms_and_conditions_partners') ? Utility::description_settings('terms_and_conditions_partners')->settings_value : ''; !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
@endsection
