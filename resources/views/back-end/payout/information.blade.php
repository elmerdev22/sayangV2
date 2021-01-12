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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <b>PARTNER : </b> <a class="text-blue" target="_blank" href="javascript:void(0)" title="Click here to view profile">John Doe's Store</a>
                            </div>
                            <div class="form-group">
                                <b>BATCH NO. : </b> PYB{{rand(11111111,99999999)}}
                            </div>            
                            <div class="form-group">
                                <b>PAYOUT NO. : </b> PY{{rand(11111111,99999999)}}
                            </div>
                            <div class="form-group">
                                <b>DATE : </b> Jan/01/2021 - {{date('M/d/Y')}}
                            </div>
                            <div class="form-group">
                                <b>STATUS : </b> <span class="badge badge-warning">pending</span> <span class="badge badge-success">completed</span>
                            </div>
                            <div class="form-group">
                                <b>PAYOUT TYPE : </b> <span class="badge badge-info">Receivable</span> <span class="badge badge-info">Partner Payout</span>
                            </div>
                            <div class="form-group">
                                <b>TOTAL ORDERS : </b> {{rand(10,100)}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <b>Sayang Commission : </b> PHP {{number_format(rand(100,1000),2)}}
                            </div>
                            <div class="form-group">
                                <b>Online Payment Fee : </b> PHP {{number_format(rand(100,1000),2)}}
                            </div>
                            <div class="form-group">
                                <b>Net Amount : </b> PHP {{number_format(rand(100,1000),2)}}
                            </div>
                            <div class="form-group">
                                <b>Total Amount : </b> PHP {{number_format(rand(100,1000),2)}}
                            </div>
                            <div class="mb-2">
                                <small>//Lalabas lang tong note at ung download receipt kung completed na kasi pag minark as processed or completed ang payout tska lang yan nalalagay. hehehehehehe. </small>
                            </div>
                            <div class="form-group">
                                <b>NOTE :</b> <br>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus numquam, accusamus aliquam facere.
                            </div>
                            <div class="form-group">
                                <a class="text-blue" href="javascript:void(0)"><i class="fas fa-download"></i> Download Receipt</a>
                            </div>

                            <div class="mb-2">
                                <small>//Pag pending pa status nakashow tong "Process This Payout" na button
                            </div>
                            <div class="form-group">
                                <button type="button" data-toggle="modal" data-target="#modal-process_payout" class="btn btn-warning btn-sm"><i class="fas fa-check"></i> Process This Payout</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4 class="text-lead">Order List</h4>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover sayang-datatables table-cell-nowrap text-center">
                            <thead>
                                <tr>
                                    <th>Order No</th>
                                    <th>Buyer Name</th>
                                    <th>Payment Method</th>
                                    <th>Total Amount</th>
                                    <th>Purchase Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($x=1;$x<=10;$x++)
                                    <tr>
                                        <td>{{rand(111111111,999999999)}}</td>
                                        <td>{{rand(111111111,999999999)}}</td>
                                        <td>{{rand(111111111,999999999)}}</td>
                                        <td>PHP {{number_format(rand(100,10000),2)}}</td>
                                        <td>Jan/01/2021</td>
                                        <td><a href="javascript:void(0);" class="btn btn-warning btn-sm">View Order</a></td>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Process Payout #{{$payout_no}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="payout_note">Note</label>
                            <textarea name="payout_note" id="payout_note" rows="5" placeholder="Add some notes here..." class="form-control @error('payout_note') is-invalid @enderror" wire:model.lazy="payout_note"></textarea>
                            @error('payout_note')
                                <span class="invalid-feedback">
                                    <span>{{$message}}</span>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="receipt">Upload Receipt</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="receipt" accept=".png, .jpeg, .jpg, .gif" wire:model="receipt">
                                    <label class="custom-file-label" for="receipt">
                                        No Receipt Selected 
                                    </label>
                                </div>
                            </div>
                            <div class="text-success" wire:loading wire:target="receipt">
                                <span class="fas fa-spin fa-spinner"></span> Uploading...
                            </div>
                            <div>
                                <small>File Size: Maximum of 1MB</small>
                            </div>
                            <div>
                                <small>File Extension: .png, .jpeg, .jpeg</small>
                            </div>
                            @error('receipt')
                                <span class="invalid-feedback d-block">
                                    <span>{{$message}}</span>
                                </span>
                            @enderror
                        </div>

                        <div class="text-right">
                            <button type="button" class="btn btn-danger btn-sm" wire:loading.attr="disabled" wire:target="store, receipt" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-warning btn-sm" wire:loading.attr="disabled" wire:target="store, receipt">
                                Process Payout <span class="fas fa-spin fa-spinner" wire:loading wire:target="store"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection