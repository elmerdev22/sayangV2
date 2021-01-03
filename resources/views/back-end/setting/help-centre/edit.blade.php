@extends('back-end.layouts.layout')
@section('title','Settings')
@section('css')
<link rel="stylesheet" href="{{asset('template/assets/dist/css/custom_inputs.css')}}">
@endsection
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Settings',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Settings'],
                ['url' => route('back-end.setting.help-centre') , 'label' => 'Help Centre'],
                ['url' => '', 'label' => ucwords($data->topic)],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <!-- CONTENT HERE -->
            @livewire('back-end.setting.help-centre.edit.form', ['help_centre_id' => $data->id])
        </div>
        <div class="col-md-8">
            <!-- CONTENT HERE -->
            <h1>Di pa tapos to</h1>
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection
@section('js')

@endsection