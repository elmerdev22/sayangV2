<div>
    <form method="POST" wire:submit.prevent="store">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12">
                    <h4>Product Details</h4>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
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
                            <label for="category">Category</label>
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
                            <label for="sub_categories">Sub Category</label>
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
                            <label for="tags">Tags</label>
                            <select class="form-control w-100" id="tags" multiple="true">
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
                        <label for="buy_now_price">Buy now price</label>
                        <input type="text" class="form-control @error('buy_now_price') is-invalid @enderror mask-money" id="buy_now_price" placeholder="0.00" wire:model.lazy="buy_now_price">
                        @error('buy_now_price') 
                            <span class="invalid-feedback">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lowest_price">Lowest price</label>
                        <input type="text" class="form-control @error('lowest_price') is-invalid @enderror mask-money" id="lowest_price" placeholder="0.00" wire:model.lazy="lowest_price">
                        @error('lowest_price') 
                            <span class="invalid-feedback">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">Description</label>
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
                        <label for="reminders">Few Reminders</label>
                        <textarea class="form-control @error('reminders') is-invalid @enderror" id="reminders" placeholder="Reminders here..." wire:model.lazy="reminders"></textarea>
                        @error('reminders') 
                            <span class="invalid-feedback">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <h4>Product Photos</h4>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Featured Photo</h5> 
                            <div class="card-tools">
                                <button type="button" class="btn btn-warning btn-sm"><i class="fas fa-upload"></i> Upload Photo
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <img src="{{asset('images/default-photo/product1.jpg')}}" class="card-img-top" alt="...">
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Other Photos</h5> 
                                <div class="card-tools">
                                    <button type="button" class="btn btn-warning btn-sm"><i class="fas fa-upload"></i> Upload Photo
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @for ($a = 0; $a < 6; $a++)
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="card">
                                                <img src="{{asset('images/default-photo/product1.jpg')}}" class="card-img-top" alt="...">
                                                <div class="card-footer text-center">
                                                    <button class="btn btn-danger btn-sm">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-warning float-right w-100">Add this Product</button>
        </div>
    </form>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        $('.mask-money').mask("#,##0.00", {reverse: true});

        $('#category').select2({theme: 'bootstrap4'});
        $('#sub_categories').select2({theme: 'bootstrap4'});
        $('#tags').select2({
            tags           : true,
            placeholder    : "Add Tags",
            tokenSeparators: [',', ' '],
                "language"     : {
                "noResults" : function () { 
                    return ''; 
                }
            },
        });

        $(document).on('change', '#sub_categories', function () {
            @this.set('sub_categories', $(this).val())
        });
        $(document).on('change', '#category', function () {
            @this.set('category', $(this).val())
            $('#sub_categories').val(null).trigger('change');
            @this.call('reset_var', ['sub_categories'])
            @this.call('reload_sub_categories')
        });
        $(document).on('change', '#tags', function () {
            @this.set('tags', $(this).val())
        });
    });

    window.livewire.on('reload_sub_categories', param => {
        var row, data = [], sub_categories;
        sub_categories = param['sub_categories'];

        for(var key in sub_categories){
            row = sub_categories[key];
            data[key] = {
                id  : row['id'],
                name: row['name']
            };
        }

        $('#sub_categories').select2(select2_child_input(data, false));
    });
</script>
@endpush