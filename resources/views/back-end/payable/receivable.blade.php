@extends('back-end.layouts.layout')
@section('title','Payout - Receivable')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Payout - Receivable',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Payout - Receivable'],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->
            @livewire('back-end.payable.receivable.listing')
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
    
    <!-- Modal -->
    <div class="modal fade" id="modal-partner_receivable" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="modal-receivable_partner_name"></span> <small>(Orders via Cash On Pickup)</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @livewire('back-end.payable.receivable.partner-receivable')
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Close </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection