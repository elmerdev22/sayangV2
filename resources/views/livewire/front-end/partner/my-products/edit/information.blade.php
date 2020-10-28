<div>
    <form method="POST" wire:submit.prevent="update">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12">
                    <h4>Product Details</h4>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_name">Product Name*</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="product_name" placeholder="Product Name" wire:model.lazy="name">
                        @error('name') 
                            <span class="invalid-feedback">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div wire:ignore wire:key="dropdown_category">
                            <label for="category">Category*</label>
                            <select class="form-control w-100 catalog" id="category">
                                <option disabled value="" selected="selected">Select</option>
                                @foreach($component->categories() as $row)
                                    <option value="{{$row->id}}">{{ucfirst($row->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category') 
                            <span class="invalid-feedback d-block">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div wire:ignore wire:key="dropdown_sub_categories">
                            <label for="sub_categories">Sub Category (optional)</label>
                            <select class="form-control w-100" id="sub_categories" multiple="true">
                            </select>
                        </div>
                        @error('sub_category') 
                            <span class="invalid-feedback d-block">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div wire:ignore wire:key="dropdown_tags">
                            <label for="tags">Tags (optional)</label>
                            <select class="form-control w-100" id="tags" multiple="true">
                                @foreach($tags as $tag)
                                    <option selected="true" value="{{$tag}}">{{$tag}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('tags') 
                            <span class="invalid-feedback d-block">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="regular_price">Regular price*</label>
                        <input type="text" class="form-control @error('regular_price') is-invalid @enderror mask-money" id="regular_price" placeholder="0.00" value="{{number_format($regular_price, 2)}}">
                        @error('regular_price') 
                            <span class="invalid-feedback">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="buy_now_price">Buy now price*</label>
                        <input type="text" class="form-control @error('buy_now_price') is-invalid @enderror mask-money" id="buy_now_price" placeholder="0.00" value="{{number_format($buy_now_price, 2)}}">
                        @error('buy_now_price') 
                            <span class="invalid-feedback">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lowest_price">Lowest price*</label>
                        <input type="text" class="form-control @error('lowest_price') is-invalid @enderror mask-money" id="lowest_price" placeholder="0.00" value="{{number_format($lowest_price, 2)}}">
                        @error('lowest_price') 
                            <span class="invalid-feedback">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">Description*</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Description here..." wire:model.lazy="description"></textarea>
                        @error('description') 
                            <span class="invalid-feedback">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="reminders">Few Reminders (optional)</label>
                        <textarea class="form-control @error('reminders') is-invalid @enderror" id="reminders" placeholder="Reminders here..." wire:model.lazy="reminders"></textarea>
                        @error('reminders') 
                            <span class="invalid-feedback">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-right">
                <button wire:target="update" wire:loading.attr="disabled" type="submit" class="btn btn-warning">
                    Save <span wire:loading wire:target="update" class="fas fa-spinner fa-spin"></span>
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        $('.mask-money').mask("#,##0.00", {reverse: true});
        $('#category').select2({theme: 'bootstrap4'});
        $('#sub_categories').select2(select2_child_input([], false, "Select"));

        var max_tag = "{{\SettingsUtility::max_tags_per_product()}}";
        $('#tags').select2(select2_tags_input("Add Tags", max_tag));

        $(document).on('keyup', '#lowest_price', function () {
            @this.set('lowest_price', $(this).val())
        });
        $(document).on('keyup', '#buy_now_price', function () {
            @this.set('buy_now_price', $(this).val())
        });
        $(document).on('keyup', '#regular_price', function () {
            @this.set('regular_price', $(this).val())
        });
        $(document).on('change', '#sub_categories', function () {
            @this.set('sub_categories', $(this).val())
        });
        $(document).find('#category').val('{{$category}}');
        $(document).find('#category').trigger('change');
        $(document).on('change', '#category', function () {
            @this.set('category', $(this).val())
            $('#sub_categories').val(null).trigger('change');
            @this.call('reset_var', ['sub_categories'])
            @this.call('reload_sub_categories')
        });

        $(document).on('change', '#tags', function () {
            @this.set('tags', $(this).val())
        });

        reload_sub_categories({!!json_encode($initial_sub_categories)!!});
    });

    window.livewire.on('reload_sub_categories', param => {
        reload_sub_categories(param);
    });

    function reload_sub_categories(param){
        var row,                     data = [], sub_categories, selected_sub_categories;
            sub_categories          = param['sub_categories'];
            selected_sub_categories = param['selected_sub_categories'];

        for(var key in sub_categories){
            row = sub_categories[key];
            data[key] = {
                id  : row['id'],
                name: row['name']
            };
        }

        $('#sub_categories').select2(select2_child_input(data, false, "Select"));
        $('#sub_categories').val(selected_sub_categories);
        $('#sub_categories').trigger('change');
    }
</script>
@endpush