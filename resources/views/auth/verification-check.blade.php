@extends('front-end.layout')
@section('title','Verification')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Verification',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Email Verification'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content" style="min-height:84vh">
    <div class="container">
        <!-- ============================ COMPONENT VERIFICATION CHECK   ================================= -->
        <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
            <div class="card-body">
                @livewire('auth.verification-check')
            </div> <!-- card-body.// -->
        </div> <!-- card .// -->
        <p class="text-center mt-4">Don't have account? <a href="#">Sign up</a></p>
        <br><br>
        <!-- ============================ COMPONENT VERIFICATION CHECK  END.// ================================= -->
    </div>
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->


<!-- Modal -->
<div id="modal-change_email" class="modal fade" @if($request_new_email) data-backdrop="static" @endif role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">{{$request_new_email ? 'Set-Up New Email Address':'Change Email Address'}}</h6>
                @if(!$request_new_email)
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                @endif
            </div>
            <div class="modal-body">
                @livewire('auth.change-email')

                @if($request_new_email)
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> <strong>NOTE: </strong> You don't have email address yet, please set new email address.
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                @if(!$request_new_email)
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                @endif
                <button type="submit" class="btn btn-primary" form="form-change_email">{{$request_new_email ? 'Set':'Change'}}  and Send Code</button>
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