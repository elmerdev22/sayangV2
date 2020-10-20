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
                <div class="col-12">
                    <div class="form-group">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Photos</h5> 
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @for ($a = 1; $a < 7; $a++)
                                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                                            <div class="card overflow-hidden @if($a==1) sayang-featured-photo-bordered @endif">
                                                <div class="position-relative">
                                                    <img src="{{asset('images/default-photo/hp-'.$a.'.png')}}" class="sayang-card-photo" alt="Product Photo">
                                                    <button type="button" class="btn btn-danger btn-sm sayang-remove-photo-overlay" title="Remove"><i class="fas fa-trash"></i></button>
                                                    @if($a==1)
                                                        <div class="sayang-featured-photo-overlay">Featured</div>
                                                    @else
                                                        <button type="button" class="btn btn-warning btn-sm sayang-set-featured-photo-overlay" title="Set as Featured">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 offset-sm-4">
                                        <div class="form-group">
                                            <label for="photos">Upload Photos</label>
                                            <input type="file" id="photos" class="form-control-file @error('photos') is-invalid @enderror" accept=".jpg, .jpeg, .png" wire:model="photos" multiple="true">
                                            <div>
                                                <small>File Size: Maximum of 2MB</small>
                                            </div>
                                            <div>
                                                <small>File Extension: .png, .jpeg, .jpeg</small>
                                            </div>
                                            @error('photos')
                                                <span class="invalid-feedback">
                                                    <span>{{$message}}</span>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
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