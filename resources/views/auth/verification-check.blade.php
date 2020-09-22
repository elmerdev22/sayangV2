@extends('front-end.layout')
@section('title','Verification')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Verification',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Verification'],
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
                @livewire('auth.verification-check')
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal-change_email" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Email Address</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                @livewire('auth.change-email')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                <button type="submit" class="btn btn-warning" form="form-change_email"><i class="fas fa-check"></i> Change and Send Code</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection