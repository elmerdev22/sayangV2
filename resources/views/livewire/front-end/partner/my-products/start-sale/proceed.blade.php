<div>
    <form method="POST" wire:submit.prevent="store">
        <div class="modal-body">
            <div class="form-group">
                @php $count = 3; @endphp
                <label>Products : {{$count}} items</label>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Buy now price</th>
                            <th scope="col">Lowest price</th>
                            <th scope="col">Quantity</th>
                        </tr>
                        </thead>
                    <tbody>
                        @foreach($selected_products as $product)
                            <tr>
                                <td>{{$product['key_token']}}</td>
                                <td>{{number_format($product['buy_now_price'],2)}}</td>
                                <td>{{number_format($product['lowest_price'],2)}}</td>
                                <td>{{number_format($product['lowest_price'])}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                </table>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" wire:model.lazy="start_date">
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date" wire:model.lazy="end_date">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">Start a Sale</button>
        </div>
    </form>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('proceed_done', param => {
        setTimeout(function () {
            Swal.close();
            $('#modal-proceed_start_sale').modal('show');
        }, 1500);
    });
</script>
@endpush