@extends('front-end.layout')
@section('title','My Cart')
@section('page_header')
    @php 
        $page_header = [
            'title'       => '<small><i class="fas fa-shopping-cart"></i> My Cart <span class="badge badge-warning badge-pill badge-total-item-in-cart">'.Utility::total_cart_item().'</span></small>',
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
    <div class="card">
    <table class="table table-borderless table-shopping-cart">
    <thead class="text-muted">
    <tr class="small text-uppercase">
      <th scope="col">Product</th>
      <th scope="col" width="120">Quantity</th>
      <th scope="col" width="120">Price</th>
      <th scope="col" class="text-right" width="200"> </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <figure class="itemside align-items-center">
                <div class="aside"><img src="../images/items/11.jpg" class="img-sm"></div>
                <figcaption class="info">
                    <a href="#" class="title text-dark">Camera Canon EOS M50 Kit</a>
                    <p class="text-muted small">Matrix: 25 Mpx <br> Brand: Canon</p>
                </figcaption>
            </figure>
        </td>
        <td> 
            <select class="form-control">
                <option>1</option>
                <option>2</option>	
                <option>3</option>	
                <option>4</option>	
            </select> 
        </td>
        <td> 
            <div class="price-wrap"> 
                <var class="price">$1156.00</var> 
                <small class="text-muted"> $315.20 each </small> 
            </div> <!-- price-wrap .// -->
        </td>
        <td class="text-right"> 
        <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light" data-toggle="tooltip"> <i class="fa fa-heart"></i></a> 
        <a href="" class="btn btn-light"> Remove</a>
        </td>
    </tr>
    <tr>
        <td>
            <figure class="itemside align-items-center">
                <div class="aside"><img src="../images/items/10.jpg" class="img-sm"></div>
                <figcaption class="info">
                    <a href="#" class="title text-dark">ADATA Premier ONE microSDXC</a>
                    <p class="text-muted small">Size: 256 GB  <br> Brand: ADATA </p>
                </figcaption>
            </figure>
        </td>
        <td> 
            <select class="form-control">
                <option>1</option>
                <option>2</option>	
                <option>3</option>	
                <option>4</option>	
            </select> 
        </td>
        <td> 
            <div class="price-wrap"> 
                <var class="price">$149.97</var> 
                <small  class="text-muted"> $75.00 each </small>  
            </div> <!-- price-wrap .// -->
        </td>
        <td class="text-right"> 
        <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light" data-toggle="tooltip"> <i class="fa fa-heart"></i></a> 
        <a href="" class="btn btn-light btn-round"> Remove</a>
        </td>
    </tr>
    <tr>
        <td>
            <figure class="itemside align-items-center">
                <div class="aside"><img src="../images/items/9.jpg" class="img-sm"></div>
                <figcaption class="info">
                    <a href="#" class="title text-dark">Logitec headset for gaming</a>
                    <p class="small text-muted">Version: CUH-ZCT2E  <br> Brand: Sony</p>
                </figcaption>
            </figure>
        </td>
        <td> 
            <select class="form-control">
                <option>1</option>
                <option>2</option>	
                <option>3</option>	
            </select> 
        </td>
        <td> 
            <div class="price-wrap"> 
                <var class="price">$98.00</var> 
                <small class="text-muted"> $578.00 each</small> 
            </div> <!-- price-wrap .// -->
        </td>
        <td class="text-right"> 
            <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light" data-toggle="tooltip"> <i class="fa fa-heart"></i></a> 
            <a href="" class="btn btn-light btn-round"> Remove</a>
        </td>
    </tr>
    </tbody>
    </table>
    
    <div class="card-body border-top">
        
        <a href="#" class="btn btn-light">Continue Shopping</a>
    </div> <!-- card-body.// -->
    
    </div> <!-- card.// -->
    
        </aside> <!-- col.// -->
        <aside class="col-lg-3">
    
    
    <div class="card">
    <div class="card-body">
            <dl class="dlist-align">
              <dt>Total price:</dt>
              <dd class="text-right">$69.97</dd>
            </dl>
            <dl class="dlist-align">
              <dt>Discount:</dt>
              <dd class="text-right text-danger">- $10.00</dd>
            </dl>
            <dl class="dlist-align">
              <dt>Total:</dt>
              <dd class="text-right text-dark b"><strong>$59.97</strong></dd>
            </dl>
            <hr>
            <p class="text-center mb-3">
                <img src="../images/misc/payments.png" height="26">
            </p>
            <a href="#" class="btn btn-primary btn-block"> Make Purchase </a>
    </div> <!-- card-body.// -->
    </div> <!-- card.// -->
    
        </aside> <!-- col.// -->
    
    
    </div> <!-- row.// -->
    <!-- ============================ COMPONENT 1 END .// ================================= -->
    
    </div> <!-- container .//  -->
</section>
    <!-- ========================= SECTION CONTENT END// ========================= -->
    
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
                title: 'No Item Selected.',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                Swal.close();
            })
        }

        function proceed_checkout(){
            $.LoadingOverlay("show");
        }
    </script>
@endsection
