@extends('front-end.layout')
@section('title','Verification')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Verification',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Verification Check'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="login-box pb-5">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                @livewire('front-end.user.verification')
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection