@extends('back-end.layouts.layout')
@section('title','Payout - Completed')
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
                    <h5 class="card-title">Completed Payables & Receivables</h5>
                </div>
                <div class="card-body">  
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                            <thead>
                                <tr>
                                    <th>Partner</th>
                                    <th>Sayang Commission</th>
                                    <th>Net Amount</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($x=1; $x<=10; $x++)
                                    <tr>
                                        <td>
                                            <a class="text-blue" href="javascript:void(0);">Elmer Shop</a>
                                        </td> 
                                        <td>PHP {{number_format(rand(100,10000),2)}}</td>
                                        <td>PHP {{number_format(rand(100,10000),2)}}</td>
                                        <td>PHP {{number_format(rand(100,10000),2)}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="{{route('back-end.payout.completed_view')}}">View</a>
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
@endsection
@section('js')

@endsection