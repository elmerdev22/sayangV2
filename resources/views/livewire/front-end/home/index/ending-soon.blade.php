<div>
    <div class="row">
        @foreach($data as $row)
            <div class="col-12 col-md-4 col-lg-3">
                @component('front-end.components.product.grid')
                    @slot('featured', $component->product_featured_photo($row->product_id, $row->partner_id))
                    @slot('countdown', $component->datetime_format($row->date_end))
                    @slot('discount_percentage', Utility::price_percentage($row->regular_price, $row->buy_now_price)['discount_percent'])

                    @slot('buy_now', route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'buy_now']))
                    @slot('bid_now', route('front-end.product.information.redirect', ['slug' => $row->product_slug, 'key_token' => $row->key_token, 'type' => 'place_bid']))

                    @slot('product_name', ucfirst($row->product_name))
                    @slot('quantity_left', number_format($row->quantity, 0))
                    @slot('buy_now_price', Utility::currency_code().''.number_format($row->buy_now_price, 2))
                    @slot('regular_price', Utility::currency_code().''.number_format($row->regular_price, 2))
                    @slot('bid_details_top', Utility::bid_details($row->id, 'top'))
                    @slot('bid_details_top_price', Utility::currency_code().''.Utility::bid_details($row->id, 'top'))
                    @slot('bid_details_count', Utility::bid_details($row->id, 'count'))

                    @slot('elements_trees', Utility::elements_multiplier($row->id)['trees'])
                    @slot('elements_water', Utility::elements_multiplier($row->id)['water'])
                    @slot('elements_energy', Utility::elements_multiplier($row->id)['energy'])
                @endcomponent
            </div> <!-- col.// -->
        @endforeach
    </div> <!-- row.// -->
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.hook('beforeDomUpdate', () => {
        $('.countdown').countdown("destroy");
    });
    window.livewire.hook('afterDomUpdate', () => {
        $('.countdown').countdown("start");
    });
    $('.countdown').countdown({
        end: function() {
            @this.call('render')
        }
    });
</script>
@endpush