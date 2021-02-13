@extends('front-end.layout')
@section('title','Bids - Win')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Win Bids',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Win Bids'],
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
                @include('front-end.includes.user.sidebar')
                <!--   SIDEBAR .//END   -->
            </aside>
            <main class="col-md-9">
                @livewire('front-end.user.my-bid.win')
            </main>
        </div> <!-- row.// -->
        <!-- =========================  COMPONENT MY PROFILE.// ========================= --> 
    </div> <!-- container .//  -->
</section>        
<!-- Modal -->
<div class="modal fade" id="modal-pay_now" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pay Now</h4>
            </div>
            <div class="modal-body">
                <div class="card box-shadow-none" id="card-payment_method">
                    <div class="card-body p-0">
                        @livewire('front-end.user.my-bid.win.pay-now')
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-payment_3d_secure" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="modal-payment_3rd_secure_iframe">
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" href="{{route('front-end.user.my-purchase.list')}}">Cancel Payment</a>
            </div> 
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection