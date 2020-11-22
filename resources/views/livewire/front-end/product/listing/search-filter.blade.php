<div>
    <div wire:ignore wire:key="search-filter">
        <article class="filter-group" id="search-keyword">
            <div class="filter-content">
                <div class="card-body">
                    <form class="pb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-warning" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </article>
        <article class="filter-group" id="accordion-category">
            <header class="card-header border-top" 
                    data-toggle="collapse" 
                    data-target="#collapse-category" 
                    data-parent="#accordion-category" 
                    aria-expanded="true"
                >
                <a href="javascript:void(0);" class="text-dark">
                    <h6 class="title"><span class="fa fa-chevron-down"></span> By Category</h6>
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
                                    data-target="#category-{{$category->slug}}"
                                    aria-expanded="false"
                                >
                                    {{ucfirst($category->name)}} <span class="fa fa-chevron-down float-right"></span>
                                </a>
                                <div class="collapse" id="category-{{$category->slug}}">
                                    <ul class="list-menu">
                                        <li>
                                            <label class="custom-control custom-checkbox product-filter-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <div class="custom-control-label"> All {{ucfirst($category->name)}}
                                            </label>
                                        </li>
                                        @foreach($category->sub_categories()->get() as $sub_category)
                                            <li>
                                                <label class="custom-control custom-checkbox product-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input">
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

        <article class="filter-group">
            <header class="card-header border-top" data-toggle="collapse" data-target="#collapse-price-range" aria-expanded="true" >
                <a href="#" class="text-dark">
                    <h6 class="title"><span class="fa fa-chevron-down"></span> Price Range</h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse-price-range">
                <div class="card-body">
                    <!-- <input type="range" class="custom-range" id="input-price_range" min="0" max="100"> -->
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Min</label>
                            <input class="form-control mask-money" id="input-price_min" placeholder="₱ MIN" type="text" maxlength="10">
                        </div>
                        <div class="form-group text-right col-sm-6">
                            <label>Max</label>
                            <input class="form-control mask-money" id="input-price_max" placeholder="₱ MAX" type="text" maxlength="10">
                        </div>
                        <div class="form-group col-12">
                            <div id="input-alert-price_range"></div>
                        </div>
                    </div> <!-- form-row.// -->
                    <button type="button" class="btn btn-block btn-warning" id="apply-price_range">Apply</button>
                </div><!-- card-body.// -->
            </div>
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
    });
</script>
@endpush