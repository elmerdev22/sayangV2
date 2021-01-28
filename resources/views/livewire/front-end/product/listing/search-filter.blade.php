<div>
    <div wire:ignore wire:key="search-filter">
        <article class="filter-group mb-2" id="accordion-category">
            <header class="card-header border-top" 
                    data-toggle="collapse" 
                    data-target="#collapse-category" 
                    data-parent="#accordion-category" 
                    aria-expanded="true"
                >
                <a href="javascript:void(0);" class="text-dark">
                    <h6>By Category</h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse-category">
                <div class="card-body">
                    <ul class="list-menu">
                        
                        <li>
                            <a  href="javascript:void(0);" wire:click="set_filter('')">
                                All Categories <span class="float-right"><small>{{$this->product_count('') != 0 ? '('.number_format($this->product_count(''), 0).')' : ''}}</small></span>
                            </a>
                        </li>
                        @foreach($categories as $category_key => $category)
                            <li>
                                <a  href="javascript:void(0);"
                                    class="collapsed {{$selected_category_id == $category->id ? 'text-warning': ''}}" 
                                    @if ($category->sub_categories->count() > 0)
                                        data-toggle="collapse"
                                        data-target="#category-{{$category->key_token}}"
                                        aria-expanded="false"
                                    @else
                                        wire:click="set_filter('{{$category->id}}')"
                                    @endif
                                >
                                    {{ucfirst($category->name)}} 
                                    
                                    @if ($category->sub_categories->count() > 0)
                                        <span class="fas fa-angle-down float-right pt-1"></span>
                                    @else
                                        <span class="float-right"><small>{{$this->product_count($category->id) != 0 ? '('.number_format($this->product_count($category->id), 0).')' : '(0)'}}</small></span>
                                    @endif
                                </a>
                                <div class="collapse" id="category-{{$category->key_token}}">
                                    <ul class="list-menu text-sm pl-2">
                                        <li>
                                            <a  href="javascript:void(0);" wire:click="set_filter('{{$category->id}}')">
                                                All {{ucfirst($category->name)}} <span class="float-right"><small>{{$this->product_count($category->id) != 0 ? '('.number_format($this->product_count($category->id), 0).')' : '(0)'}}</small></span>
                                            </a>
                                            {{-- <span class="fas fa-caret-right"></span> --}}
                                        </li>
                                        @foreach($category->sub_categories as $sub_category)
                                            <li>
                                                <a  href="javascript:void(0);" wire:click="set_filter('{{$sub_category->id}}','sub_category')">
                                                    {{ucfirst($sub_category->name)}} </span>
                                                    <span class="float-right"><small>{{$this->product_count($sub_category->id, 'sub_category') != 0 ? '('.number_format($this->product_count($sub_category->id, 'sub_Category'), 0).')' : '(0)'}}</small>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div> <!-- card-body.// -->
            </div>
        </article> <!-- filter-group  .// -->

        <article class="filter-group mb-2">
            <header class="card-header border-top" data-toggle="collapse" data-target="#collapse-price-range" aria-expanded="true" >
                <a href="javascript:void(0);" class="text-dark">
                    <h6>Price Range</h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse-price-range">
                <div class="card-body">
                    <!-- <input type="range" class="custom-range" id="input-price_range" min="0" max="100"> -->
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Min</label>
                            <input class="form-control mask-money" wire:loading.attr="readonly" wire:target="set_price_range" id="input-price_min" placeholder="₱ MIN" type="text" maxlength="10">
                        </div>
                        <div class="form-group text-right col-sm-6">
                            <label>Max</label>
                            <input class="form-control mask-money" wire:loading.attr="readonly" wire:target="set_price_range" id="input-price_max" placeholder="₱ MAX" type="text" maxlength="10">
                        </div>
                        <div class="form-group col-12">
                            <div id="input-alert-price_range"></div>
                        </div>
                    </div> <!-- form-row.// -->
                    <button type="button" wire:loading.attr="disabled" wire:target="set_price_range" class="btn btn-block btn-warning" id="apply-price_range">
                        Apply <span wire:loading wire:target="set_price_range" class="fas fa-spin fa-spinner"></span>
                    </button>
                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->

        <article class="filter-group">
            <header class="card-header border-top">
                <button type="button" wire:loading.attr="disabled" wire:target="clear_filter" onclick="clear_filter()" class="btn btn-block btn-warning" id="clear-filter">
                    Clear Filter <span wire:loading wire:target="clear_filter" class="fas fa-spin fa-spinner"></span>
                </button>
            </header>
        </article> <!-- filter-group .// -->
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    function clear_filter(){
        $('#input-price_min').val('');
        $('#input-price_max').val('');
        $('#input-search').val('');
        
        @this.call('clear_filter')
    }
    
</script>
@endpush