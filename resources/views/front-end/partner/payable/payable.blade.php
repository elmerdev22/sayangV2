@extends('front-end.partner.layouts.layout')
@section('title','Payout - Payable')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Payout - Payable',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Payout - Payable'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('front-end.partner.payable.payable.listing')
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-proceed" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payables - Proceed</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @livewire('front-end.partner.payable.payable.proceed')
                </div>
            </div>
        </div>
    </div>
@endsection