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
<div id="modal-change_email" class="modal fade" @if($request_new_email) data-backdrop="static" @endif role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$request_new_email ? 'Set-Up New Email Address':'Change Email Address'}}</h4>
                @if(!$request_new_email)
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                @endif
            </div>
            <div class="modal-body">
                @livewire('auth.change-email')

                @if($request_new_email)
                    <strong>NOTE: </strong> You don't have email address yet, please set new email address.
                @endif
            </div>
            <div class="modal-footer">
                @if(!$request_new_email)
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                @endif
                <button type="submit" class="btn btn-warning" form="form-change_email"><i class="fas fa-check"></i> {{$request_new_email ? 'Set':'Change'}}  and Send Code</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        @if($request_new_email)
            $('#modal-change_email').modal('show');
        @endif
    });
</script>
@endsection