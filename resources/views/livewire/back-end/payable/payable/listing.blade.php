<div>
    @forelse($data as $row)
        @php 
            $payouts       = $component->order_payment_payouts($row->id);
            $payouts_count = $payouts->count();
            $payouts_get   = $payouts->get();
        @endphp
        @if($payouts_count > 0)
            <div class="row">
                <div class="col-12">
                    <div class="card card-warning @if($i != 1) collapsed-card @endif">
                        <div class="card-header">
                            <h3 class="card-title">
                                Batch No. #{{$row->batch_no}} | {{date('M/d/Y', strtotime($row->date_from))}} - strtotime($row->date_to))}}
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0 m-0" @if($i != 1) style="display: none;" @endif>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center m-0 p-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 20px;">#</th>
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
                                                <td class="text-center">{{$x}}.)</td>
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
                                                    <a class="btn btn-sm btn-default" href="javascript:void(0);">Process</a>
                                                    <a class="btn btn-sm btn-warning" href="javascript:void(0);">View</a>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th colspan="4" class="text-center">TOTAL</th>
                                            <th>PHP {{number_format(rand(100,10000),2)}}</th>
                                            <th>PHP {{number_format(rand(100,10000),2)}}</th>
                                            <th>PHP {{number_format(rand(100,10000),2)}}</th>
                                            <th>PHP {{number_format(rand(100,10000),2)}}</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @empty
        <h4 class="text-center text-muted">No Pending Payable Found</h4>
    @endforelse
</div>
