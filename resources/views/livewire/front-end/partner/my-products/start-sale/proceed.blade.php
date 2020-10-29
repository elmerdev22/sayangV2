<div>
    <form method="POST" wire:submit.prevent="store">
        <div class="modal-body">
            <div class="form-group">
                <label>Products : {{number_format(count($selected_products), 0)}} items</label>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            {{-- <th scope="col">Regular price</th> --}}
                            <th scope="col">Buy now price</th>
                            <th scope="col">Lowest price</th>
                            <th scope="col">Quantity</th>
                        </tr>
                        </thead>
                    <tbody>
                        @foreach($selected_products as $product)
                            <tr>
                                <td>{{ucfirst($component->product($product['product_id'])->name)}}</td>
                                {{-- <td>{{number_format($product['regular_price'],2)}}</td> --}}
                                <td>{{number_format($product['buy_now_price'],2)}}</td>
                                <td>{{number_format($product['lowest_price'],2)}}</td>
                                <td>{{number_format($product['quantity'])}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" wire:model.lazy="start_date">
                @error('start_date')
                    <span class="invalid-feedback">
                        <span>{{$message}}</span>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" wire:model.lazy="end_date">
                @error('end_date')
                    <span class="invalid-feedback">
                        <span>{{$message}}</span>
                    </span>
                @enderror
            </div>

            @error('selected_products')
                <span class="invalid-feedback d-block">
                    <span>{{$message}}</span>
                </span>
            @enderror
        </div>
        <div class="modal-footer">
            <button wire:target="store" wire:loading.attr="disabled" type="submit" class="btn btn-primary">
                Start a Sale <span wire:loading wire:target="store" class="fas fa-spinner fa-spin"></span>
            </button>
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