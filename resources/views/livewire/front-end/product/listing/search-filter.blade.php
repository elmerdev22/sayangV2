<div>
    <div wire:ignore wire:key="search-filter">
        <article class="filter-group" id="search-keyword">
            <div class="filter-content">
                <div class="card-body">
                    <div class="input-group">
                        <input type="search" class="form-control" id="input-search" value="{{$search}}" placeholder="Search key word..." wire:loading.attr="readonly" wire:target="set_search">
                        <div class="input-group-append">
                            <button class="btn btn-warning" id="btn-search" type="button" wire:loading.attr="disabled" wire:target="set_search"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </article>
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
                        @foreach($categories as $category_key => $category)
                            <li>
                                <a  href="javascript:void(0);"
                                    class="collapsed" 
                                    data-toggle="collapse"
                                    data-target="#category-{{$category->key_token}}"
                                    aria-expanded="false"
                                >
                                    {{ucfirst($category->name)}} <span class="fa fa-chevron-down float-right"></span>
                                </a>
                                <div class="collapse" id="category-{{$category->key_token}}">
                                    <ul class="list-menu">
                                        <li>
                                            <label class="custom-control custom-checkbox product-filter-checkbox">
                                                <input  type="checkbox" 
                                                        class="custom-control-input checkbox-parent-category" 
                                                        id="select-category-{{$category->key_token}}"
                                                        data-parent_key_token="{{$category->key_token}}"
                                                        onclick="select_category('{{$category->key_token}}')">
                                                <div class="custom-control-label"> All {{ucfirst($category->name)}}
                                            </label>
                                        </li>
                                        @foreach($category->sub_categories as $sub_category)
                                            <li>
                                                <label class="custom-control custom-checkbox product-filter-checkbox">
                                                    <input  type="checkbox" 
                                                            class="custom-control-input checkbox-sub-category select-sub-category-{{$category->key_token}}"
                                                            data-key_token="{{$sub_category->key_token}}"
                                                            data-parent_key_token="{{$category->key_token}}"
                                                            onclick="selected_sub_category()">
                                                    <div class="custom-control-label"> {{ucfirst($sub_category->name)}}
                                                </label>
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
                <a href="#" class="text-dark">
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
                <button type="button" wire:loading.attr="disabled" wire:target="set_price_range, clear_filter" onclick="clear_filter()" class="btn btn-block btn-warning" id="clear-filter">
                    Clear Filter
                </button>
            </header>
        </article> <!-- filter-group .// -->
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        $('.mask-money').mask("#####", {reverse: true});
        $(document).on('click', '#apply-price_range', function () {
            var price_min  = $('#input-price_min').val();
            var price_max  = $('#input-price_max').val();

            if(price_min == '' || price_max == '' || price_min == 'Nan' || price_max == 'Nan'){
                $('#input-alert-price_range').html(`<div class="invalid-feedback d-block">Please input valid price range</div>`);
                return false;
            }else{
                price_min  = parseInt($('#input-price_min').val());
                price_max  = parseInt($('#input-price_max').val());
            }
            
            if(price_min > price_max){
                $('#input-alert-price_range').html(`<div class="invalid-feedback d-block">Invalid Price Range Amount</div>`);
            }else{
                $('#input-alert-price_range').html('');
                @this.call('set_price_range', price_min, price_max)
            }
        });

        $(document).on('click', '#btn-search', function () {
            var key_word = $('#input-search').val();
            if(key_word != ''){
                @this.call('set_search', key_word)
            }
        });
    });

    function select_category(key_token){
        
        var select_category = $(document).find('#select-category-'+key_token);
        if(select_category.is(':checked')){
            var is_checked = true;
        }else{
            var is_checked = false;
        }

        $(document).find('.select-sub-category-'+key_token).each(function () {
            $(this).prop('checked', is_checked);
        });
        
        selected_sub_category();
    }

    function selected_sub_category(){
        var category          = [];
        var sub_category      = [];
        var parent_key_tokens = [];

        $(document).find('.checkbox-sub-category').each(function () {
            if($(this).is(':checked')){
                sub_category.push($(this).data('key_token'));
            }

            var parent_key_token = $(this).data('parent_key_token');

            if(!parent_key_tokens.includes(parent_key_token)){
                parent_key_tokens.push(parent_key_token);
                is_category_checked_all(parent_key_token);
            }
        });

        $(document).find('.checkbox-parent-category').each(function () {
            if($(this).is(':checked')){
                category.push($(this).data('parent_key_token'));
            }
        });

        @this.call('set_category', category, sub_category);
    }

    function is_category_checked_all(key_token){
        var is_checked_all   = [];
        $(document).find('.select-sub-category-'+key_token).each(function (){
            if(!$(this).is(':checked')){
                is_checked_all.push(false);
            }else{
                is_checked_all.push(true);
            }
        });

        if(is_checked_all.includes(false)){
            $(document).find('#select-category-'+key_token).prop('checked', false);
        }else{
            $(document).find('#select-category-'+key_token).prop('checked', true);
        }
    }

    function clear_filter(){
        $('#input-price_min').val('');
        $('#input-price_max').val('');
        $('#input-search').val('');
        $('#collapse-category').find('.custom-control-input').each(function () {
            $(this).prop('checked', false);
        });
        
        @this.call('clear_filter')
    }
    
</script>
@endpush