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
          
<div class="row">
    <aside class="col-md-3 mb-3">
        @include('front-end.includes.user.aside')
    </aside> <!-- col.// -->
    <main class="col-md-9">
        @livewire('front-end.user.my-bid.win')
    </main> <!-- col.// -->
</div>

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

@endsection