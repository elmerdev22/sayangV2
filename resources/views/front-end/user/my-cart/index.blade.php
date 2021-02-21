@extends('front-end.layout')
@section('title','My Cart')
@section('page_header')
    @php 
        $page_header = [
            'title'       => '<small><i class="fas fa-shopping-cart"></i> My Cart <span class="badge badge-primary badge-pill badge-total-item-in-cart">'.Utility::total_cart_item().'</span></small>',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'My Cart'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')

<section class="section-content padding-y bg">
    <div class="container">
        <!-- ============================ COMPONENT 1 ================================= -->
        
        <div class="row">
            <aside class="col-lg-9">
                @livewire('front-end.user.my-cart.index.listing')
            </aside> <!-- col.// -->
            <!-- col.// -->
            <aside class="col-lg-3">
                @livewire('front-end.user.my-cart.index.check-out')
            </aside>
        </div> <!-- row.// -->
        
        <!-- ============================ COMPONENT 1 END .// ================================= -->
    </div> <!-- container .//  -->
</section>
    
@endsection
@section('js')
<script src="{{asset('template/assets/dist/js/loadingoverlay.min.js')}}"></script>
    <script type="text/javascript">
        $.LoadingOverlaySetup({
            image: "{{Utility::img_source('loading')}}",
        });
        @if(Session::has('check_out_item_alert'))
            no_item_alert();
        @endif
        
        function no_item_alert(){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No Product selected.',
            }).then((result) => {
                Swal.close();
            })
        }

        function proceed_checkout(){
            $.LoadingOverlay("show");
        }
    </script>
@endsection
