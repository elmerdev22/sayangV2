@extends('back-end.layouts.layout')
@section('title','Payout - To Receive')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Payout - To Receive',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Payout - To Receive'],
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
        <div class="modal fade" id="modal-view_receivables" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Elmer Shop <small>(Orders via Cash On Pickup)</small></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Orders Completed Start From</label>
                                    <input type="date" class="form-control" wire:model="date_from" value="01-01-2021">
                                </div>
                                <div class="col-md-6">
                                    <label>Orders Completed Start From</label>
                                    <input type="date" class="form-control" wire:model="date_to" value="{{date('Y-m-d')}}">
                                </div>
                            </div>
                            <div class="text-right mt-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning btn-sm" wire:loading.attr="disabled" wire:target="update">
                                        Continue <i class="fas fa-caret-right"></i> <i class="fas fa-spin fa-spinner" wire:loading wire:target="update"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="form-group">
                            <b>ORDER DATE: </b> {{date('M/d/Y', strtotime('2020-01-01'))}} - {{date('M/d/Y', strtotime('2020-01-01'))}}
                        </div>
                        <form method="POST">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>Order No.</th>
                                            <th>Buyer Name</th>
                                            <th>Purchase Date</th>
                                            <th>Completed Date</th>
                                            <th>Total Amount</th>
                                            <th>Sayang Commission</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($x=1;$x<=10;$x++)
                                            <tr>
                                                <td>PN2101120687{{$x}}</td>
                                                <td>
                                                    <a class="text-blue" target="_blank" href="javascript:void(0);">Pedro Penduco</a>
                                                </td>
                                                <td>{{date('M/d/Y')}}</td>
                                                <td>{{date('M/d/Y')}}</td>
                                                <td>PHP {{number_format(rand(100,10000),2)}}</td>                          
                                                <td>PHP {{number_format(rand(100,10000),2)}}</td>                          
                                                <td>
                                                    <a class="btn btn-sm btn-warning" href="javascript:void(0);">Track</a>
                                                </td>                          
                                            </tr>
                                        @endfor
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-center">TOTAL</th>
                                            <th>PHP {{number_format(rand(100,10000),2)}}</th>
                                            <th>PHP {{number_format(rand(100,10000),2)}}</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>
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