<div>
  <div class="card-header">
    <div class="col-12">
      <h5 class="p-0 m-0">
        <span class="p-2">BUY NOW</span>
        <label class="switch">

          <input type="checkbox" {{$buy_now ? '':'checked'}} wire:change="change_action({{$buy_now}})">
          <span class="slider round"></span>
          
        </label>
        <span class="p-2">PLACE BID</span>
      </h5>
    </div>
  </div>
  <div class="card-body">
  	@if($buy_now)
  		<p>Grab this item now!</p>
  		<div class="col-12">
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
      </div>
      <div class="bg-warning py-1 px-2 mt-4">
        <h4 class="mb-0 text-white">
          Your Total: Php 120
        </h4>
      </div>
  		<p>You save Php 40 (30% off)</p>
  	@else
      <p>Top bidders get the remaining items after auction ends!</p>
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <label>Minimum Bid: Php 20 </label>
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <button class="btn btn-default"><span class="fas fa-minus"></span></button>
              </div>
              <input type="number" class="form-control text-center" min="0" value="100">
              <div class="input-group-append">
                <button class="btn btn-default"><span class="fas fa-plus"></span></button>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <label>Quantiy</label>
            <input type="number" class="form-control form-control-sm  text-center" min="1" value="3">
          </div>
        </div>
      </div>
      <div class="bg-warning py-1 px-2 mt-4">
        <h4 class="mb-0 text-white">
          Your Total: Php 120
        </h4>
      </div>
      <div class="py-2 px-3 mt-4">
        <button class="btn btn-default w-100">CONFIRM BID</button>
      </div>
      <hr>
      <p>Rankings | Total Bids: 16</p>
      <table class="table table-bordered table-sm">
      <thead>
        <tr>
          <th scope="col">Rank</th>
          <th scope="col">Name</th>
          <th scope="col">Bid</th>
          <th scope="col">Qty</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>100</td>
          <td>2</td>
          <td>Winning</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>90</td>
          <td>3</td>
          <td>Winning</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Jacob</td>
          <td>80</td>
          <td>4</td>
          <td>Winning</td>
        </tr>
      </tbody>
    </table>
  	@endif
  </div>
  <div class="card-footer bg-white">
    @if($buy_now)
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
    @else
    @endif
  </div>
</div>
