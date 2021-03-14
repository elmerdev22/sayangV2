@extends('front-end.layout')
@section('title','Purchase List')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Purchase',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Purchase List'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
<section class="section-content padding-y bg">
    <div class="container">
        <!-- =========================  COMPONENT MY PROFILE ========================= --> 
        <div class="row">
            <aside class="col-md-3">
                <!--   SIDEBAR   -->
                @include('front-end.includes.user.aside')
                <!--   SIDEBAR .//END   -->
            </aside>
            <main class="col-md-9">
                @livewire('front-end.user.my-purchase.order-placed.index')
            </main>
        </div> <!-- row.// -->
        <!-- =========================  COMPONENT MY PROFILE.// ========================= --> 
    </div> <!-- container .//  -->
</section>        

<!-- Modal -->
<div class="modal fade" id="modal-qr_code" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order No. : <span id="modal-qr_code_order_no"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @livewire('front-end.user.my-purchase.qr-code')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script type="text/javascript">
        @if(Session::has('checkout_payment'))
            @php $checkout_status = Session::get('checkout_payment'); @endphp
            @if($checkout_status['success'])
                var config = {
                    position: 'center',
                    icon    : 'success',
                    title   : 'Successful!',
                    html    : 'Order Successfully Processed'
                };
                Swal.fire(config);
            @else
                var config = {
                    position: 'center',
                    icon    : 'error',
                    title   : 'Order Failed To Process.',
                    html    : "{{$checkout_status['message']}}"
                };
                Swal.fire(config);
            @endif
        @endif
    </script>
@endsection