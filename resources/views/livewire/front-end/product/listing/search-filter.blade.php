<div>
    <div class="card">
        <article wire:ignore class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Categories</h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_1" style="">
                <div class="card-body">
                    <ul class="list-menu">
                        
                        <li>
                            <a  href="javascript:void(0);" wire:click="set_filter('')">
                                All Categories <b class="badge badge-pill badge-light float-right">{{$this->product_count('') != 0 ? number_format($this->product_count(''), 0): ''}}</b>
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
                                        <b class="badge badge-pill badge-light float-right">{{$this->product_count($category->id) != 0 ? number_format($this->product_count($category->id), 0) : '0'}}</b>
                                    @endif
                                </a>
                                <div class="collapse" id="category-{{$category->key_token}}">
                                    <ul class="list-menu text-sm pl-2">
                                        <li>
                                            <a  href="javascript:void(0);" wire:click="set_filter('{{$category->id}}')">
                                                All {{ucfirst($category->name)}} <b class="badge badge-pill badge-light float-right">{{$this->product_count($category->id) != 0 ? number_format($this->product_count($category->id), 0) : '0'}}</b>
                                            </a>
                                            {{-- <span class="fas fa-caret-right"></span> --}}
                                        </li>
                                        @foreach($category->sub_categories as $sub_category)
                                            <li>
                                                <a  href="javascript:void(0);" wire:click="set_filter('{{$sub_category->id}}','sub_category')">
                                                    {{ucfirst($sub_category->name)}} </span>
                                                    <b class="badge badge-pill badge-light float-right">{{$this->product_count($sub_category->id, 'sub_category') != 0 ? number_format($this->product_count($sub_category->id, 'sub_Category'), 0) : '0'}}</b>
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
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Price range </h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_3" style="">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Min</label>
                            <input class="form-control" id="input-price_min"  placeholder="{{Utility::currency_code()}} MIN" type="number" min="0" maxlength="10" required>
                        </div>
                        <div class="form-group text-right col-md-6">
                            <label>Max</label>
                            <input class="form-control" id="input-price_max"  placeholder="{{Utility::currency_code()}} MAX" type="number" min="1" maxlength="10" required>
                        </div>
                    </div> <!-- form-row.// -->
                    <button type="button" class="btn btn-block btn-primary" onclick="set_price_range()">
                        Apply <span wire:loading wire:target="set_price_range" class="fas fa-spin fa-spinner"></span>
                    </button>
                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
        {{-- <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_4" aria-expanded="true" class="">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Condition </h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_4" style="">
                <div class="card-body">
                    <label class="custom-control custom-radio">
                        <input type="radio" name="myfilter_radio" checked="" class="custom-control-input">
                        <div class="custom-control-label">Any condition</div>
                    </label>
    
                    <label class="custom-control custom-radio">
                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                        <div class="custom-control-label">Brand new </div>
                    </label>
    
                    <label class="custom-control custom-radio">
                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                        <div class="custom-control-label">Used items</div>
                    </label>
    
                    <label class="custom-control custom-radio">
                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                        <div class="custom-control-label">Very old</div>
                    </label>
                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// --> --}}
        <article class="filter-group">
            <div class="filter-content">
                <div class="card-body">
                    <button type="button" wire:loading.attr="disabled" wire:target="clear_filter" onclick="clear_filter()" class="btn btn-block btn-primary" id="clear-filter">
                        Clear Filter <span wire:loading wire:target="clear_filter" class="fas fa-spin fa-spinner"></span>
                    </button>
                </div>
            </div>
        </article> <!-- filter-group .// -->
    </div> <!-- card.// -->
</div>

@push('scripts')
<script type="text/javascript">
    function clear_filter(){
        $('#input-price_min').val('');
        $('#input-price_max').val('');
        $('#input-search').val('');
        
        @this.call('clear_filter')
    }
    function set_price_range(){

        var min_price = $('#input-price_min').val();
        var max_price = $('#input-price_max').val();
        
        @this.call('set_price_range', min_price, max_price)
    }
    
</script>
@endpush