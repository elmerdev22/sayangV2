<div>
    @if ($data->count() > 0)
        <section class="section-content padding-y">
            <div class="container">
                <div class="row">
                    <div class="col-12 mb-2">
                        <header class="section-heading">
                            <a href="{{route('front-end.product.list.index')}}" class="btn btn-outline-primary float-right">See all</a>
                            <h5 class="section-title">More Like This</h5>
                        </header>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">    
                        <div class="owl-carousel owl-theme">
                            @foreach($data as $row)
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
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