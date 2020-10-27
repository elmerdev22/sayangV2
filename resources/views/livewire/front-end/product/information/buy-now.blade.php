<div>
    <p>Grab this item now!</p>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h4>Php 40.00</h4>
        </div>
        <div class="col-md-2 text-center">
            <span class="fas fa-times"></span>
        </div>
        <div class="col-md-5">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <button class="btn btn-default"><span class="fas fa-minus"></span></button>
                </div>
                <input type="number" class="form-control form-control-sm  text-center" min="1" value="3">
                <div class="input-group-append">
                    <button class="btn btn-default"><span class="fas fa-plus"></span></button>
                </div>
            </div>
        </div>
    </div>                 
    <div class="bg-warning py-1 px-2 mt-4">
        <h4 class="mb-0 text-white">Your Total: Php 120</h4>
    </div>
    <p>You save Php 40 (30% off)</p>

    <div class="card-footer bg-white">
        <div class="row">
            <div class="col-lg-6 col-md-12 p-1">
                <a href="{{url('my-cart')}}">
                    <button class="btn btn-default w-100"><span class="fas fa-shopping-cart"></span> Add to Cart</button>
                </a>
            </div>
            <div class="col-lg-6 col-md-12 p-1">
                <button class="btn btn-default w-100"><span class="fas fa-shopping-basket"></span> Checkout</button>
            </div>
        </div>
    </div>
</div>
