@extends('back-end.layouts.layout')
@section('title','Payout - To Pay')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Payout - To Pay',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Payout - To Pay'],
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
                    <h5 class="card-title">Payout to Pay <small>(Orders via E-Wallet & Card)</small></h5>
                    <div class="card-tools">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-process_payout" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> Payout To Pay </a>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body">  
                    <div class="mb-2">
                        <small>//Bali List ito ng payouts na inadd sa Payout to Pay, pending pa ito hindi pa sya totally nasa completed, Gagawin kasi nya jan bago sya mag process ng mga payouts mag aadd muna sya ng ready to payouts ng mga partners, then un nga ung add payout tapos pag nakapag add sya non pending pa un monitoring nya to para dito sya titingin ng mga list ng ttransferan nya ng payouts ng partners, then pag na transfer na nya i-clclick nya ung process button sa table nayan tapos dun sya mag uupload ng receipt at add note (not required) then tsaka sya ma reremarks as completed.</small>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                            <thead>
                                <tr>
                                    <th>Partner</th>
                                    <th>Payout No</th>
                                    <th>Date From</th>
                                    <th>Date To</th>
                                    <th>Sayang Commission</th>
                                    <th>Online Payment Fee</th>
                                    <th>Net Amount</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($x=1; $x<=10; $x++)
                                    <tr>
                                        <td>
                                            <a class="text-blue" href="javascript:void(0);">{{rand(10000,999999)}}</a>
                                        </td>
                                        <td>
                                            <a class="text-blue" href="javascript:void(0);">{{rand(10000,999999)}}</a>
                                        </td>
                                        <td>Jan/01/2021</td>
                                        <td>{{date('M/d/Y')}}</td>
                                        <td>PHP {{number_format(rand(100,10000),2)}}</td>
                                        <td>PHP {{number_format(rand(100,10000),2)}}</td>
                                        <td>PHP {{number_format(rand(100,10000),2)}}</td>
                                        <td>PHP {{number_format(rand(100,10000),2)}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="javascript:void(0);">Process</a>
                                            <a class="btn btn-sm btn-primary" href="javascript:void(0);">View</a>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    
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
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Orders Date Start From</label>
                                    <input type="date" class="form-control" wire:model="date_from" value="01-01-2021">
                                </div>
                                <div class="col-md-6">
                                    <label>Orders Date Start From</label>
                                    <input type="date" class="form-control" wire:model="date_to" value="{{date('Y-m-d')}}">
                                </div>
                            </div>
                            <div class="text-right mt-3">
                                <div class="form-group">
                                    <button type="button" class="btn btn-warning btn-sm">Continue <i class="fas fa-caret-right"></i></button>
                                </div>
                            </div>
                        </form>

                        <form method="POST">
                            <hr>
                            <div class="mb-2">
                                <small>
                                    //Lalabas lang tong section nato pag naka select na ng date sa taas tapos pag click ng continue button. Bali lalabas lang dito ung mga partners na may payouts between that date na selected. So kung ang partner walang orders completed between that date wala siya sa list ng magegenerate na payout.
                                </small>
                            </div>
                            <div class="form-group">
                                <b>ORDER DATE: </b> Jan/01/2021 - {{date('M/d/Y')}}
                            </div>
                            <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                                <thead>
                                    <tr>
                                        <th>Partner</th>
                                        <th>Sayang Commission</th>
                                        <th>Online Payment Fee</th>
                                        <th>Net Amount</th>
                                        <th>Total Amount</th>
                                        <th>Total Orders</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($x=1;$x<=10;$x++)
                                        <tr>
                                            <td>
                                                <a class="text-blue" target="_blank" href="javascript:void(0);">{{rand(10000,999999)}}</a>
                                            </td>
                                            <td>PHP {{number_format(rand(100,10000),2)}}</td>
                                            <td>PHP {{number_format(rand(100,10000),2)}}</td>
                                            <td>PHP {{number_format(rand(100,10000),2)}}</td>
                                            <td>PHP {{number_format(rand(100,10000),2)}}</td>                            
                                            <td>{{number_format(rand(1,100))}}</td>
                                            <td>
                                                <div class="icheck-warning">
                                                    <input type="checkbox" id="select-{{$x}}" checked="true">
                                                    <label for="select-{{$x}}"></label>
                                                </div>
                                            </td>                            
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>

                            <div class="text-right mt-3">
                                <div class="form-group">
                                    <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Cancel</button>
                                    <button type="button" class="btn btn-warning btn-sm"><i class="fas fa-check"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('js')

@endsection