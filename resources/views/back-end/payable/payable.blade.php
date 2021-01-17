@extends('back-end.layouts.layout')
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
    @include('back-end.layouts.includes.page-header', $page_header)
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- CONTENT HERE -->
        
            <div class="card card-outline card-sayang mb-3">
                <div class="card-header">
                    <h5 class="card-title">Payout Payable <small>(Orders via E-Wallet & Card)</small></h5>
                    <div class="card-tools">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-process_payout" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> Add Payable Payout </a>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('back-end.payable.payable.listing')
                </div>
            </div>

        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->

    <!-- Modal -->
    <div class="modal fade" id="modal-process_payout" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Process Payout - To Pay <small>(Orders via E-Wallet & Card)</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @livewire('back-end.payable.payable.process-payout-date')
                    @livewire('back-end.payable.payable.process-payout')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection