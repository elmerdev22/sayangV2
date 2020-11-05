@extends('front-end.layout')
@section('title','Check Out')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Checkout',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Checkout'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')

<div class="container">

    <div class="row">
        <main class="col-md-8">
            <h4 class="mb-3"><i class="fas fa-file-invoice"></i> Billing address</h4>
            <div class="card card-sayang">
                <div class="card-body">
                    @livewire('front-end.user.check-out.index.billing')
                    <hr class="mb-4">
                    @livewire('front-end.user.check-out.index.payment-method')
                </div>
            </div> <!-- card.// -->
        </main> <!-- col.// -->

        <aside class="col-md-4 order-md-2 mb-4">
            @livewire('front-end.user.check-out.index.my-cart')

            <form class="card p-2">
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label>Get a voucher?</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="" placeholder="Enter code here">
                                <span class="input-group-append"> 
                                <button class="btn btn-warning text-white">Apply</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div> <!-- card-body.// -->
            </form>
        </aside> <!-- col.// -->
    </div>

</div> <!-- container .//  -->

<!-- Modal -->
<div class="modal fade" id="qrcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order ID : 00001234567</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="row pb-2">
                    <div class="col-12">
                        <h4>Purchased Completed!</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {!! QrCode::size(200)->generate('Elmer Lang Malakas!'); !!}
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-12">
                        <a href="{{route('front-end.user.my-purchase.list')}}" class=""><u>Go to my purchased</u> </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script type="text/javascript">
        
    </script>
@endsection
