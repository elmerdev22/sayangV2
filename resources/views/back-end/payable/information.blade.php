@extends('back-end.layouts.layout')
@section('title','Payout - #'.$payout_no)
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Payout - #'.$payout_no,
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Payout - #'.$payout_no],
            ],
        ];
    @endphp
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->

            <div class="card card-outline card-sayang mb-3">
                <div class="card-header">
                    <h5 class="card-title">Payout #{{$payout_no}}</h5>
                </div>
                <div class="card-body">
                    @livewire('back-end.payable.information.index', ['payout_id' => $payout->id])
                    <hr>
                    <h4 class="text-lead">Order List</h4>
                    @livewire('back-end.payable.information.order-listing', ['payout_id' => $payout->id])
                </div>
            </div>
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
    @if($payout->status == 'pending')
        <!-- Modal -->
        <div class="modal fade" id="modal-confirm_process_payout" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Payout</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @livewire('back-end.payable.confirm-process-payout', ['payout_id' => $payout->id])
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('js')

@endsection