@extends('back-end.layouts.layout')
@section('title','Payout - Completed - '.ucfirst($partner->name))
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Payout - Completed',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Payout - Completed'],
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
                    <h5 class="card-title">Completed Payables (Orders via E-Wallet & Card)</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body">  
                    <h5>Kaw na bahala pre kung san mo pwedeng lagyan ng search or kahit ano na makakatulong</h5>
                    @for ($i = 0; $i < 5; $i++)
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-warning collapsed-card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <button type="button" class="btn btn-default btn-xs btn-print" data-invoice_no="MN20200919-000007-364" title="Print"><i class="fas fa-print"></i></button>&nbsp;&nbsp;
                                            January/01/2021
                                            - January/15/2021 Payables #MN20200919-000007-364
                                        </h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0 m-0" style="display: none;">
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
                                                    @for($x=1;$x<=7;$x++)
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
                                                                <a class="btn btn-xs btn-warning" href="javascript:void(0);">Track</a>
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
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>    
                    @endfor
                </div>
            </div>
            <div class="card card-outline card-sayang mb-3">
                <div class="card-header">
                    <h5 class="card-title">Completed Receivables (Orders via Cash On Pickup)</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    </div>
                </div>
                <div class="card-body"> 
                    <h5>Kaw na bahala pre kung san mo pwedeng lagyan ng search or kahit ano na makakatulong</h5>

                    @for ($i = 0; $i < 5; $i++)
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-warning collapsed-card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <button type="button" class="btn btn-default btn-xs btn-print" data-invoice_no="MN20200919-000007-364" title="Print"><i class="fas fa-print"></i></button>&nbsp;&nbsp;
                                            September/19/2020
                                            - Receivables #MN20200919-000007-364
                                        </h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0 m-0" style="display: none;">
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
                                                    @for($x=1;$x<=7;$x++)
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
                                                                <a class="btn btn-xs btn-warning" href="javascript:void(0);">Track</a>
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
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>    
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <!-- 
        NOTE: Always wrap the content in .row > .col-* 
    -->
@endsection
@section('js')

@endsection