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
                        <input type="text" class="form-control @error('regular_price') is-invalid @enderror mask-money" id="regular_price" placeholder="0.00">
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
                        <input type="text" class="form-control @error('buy_now_price') is-invalid @enderror mask-money" id="buy_now_price" placeholder="0.00">
                        @error('buy_now_price') 
                            <span class="invalid-feedback">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lowest_price">Lowest price/Bidding start price*</label>
                        <input type="text" class="form-control @error('lowest_price') is-invalid @enderror mask-money" id="lowest_price" placeholder="0.00">
                        @error('lowest_price') 
                            <span class="invalid-feedback">
                                <span>{{$message}}</span>
                            </span> 
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="text" readonly="true" class="form-control" id="discount" value="{{number_format($discount, 2)}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="discount_percent">Discount Percent</label>
                        <input type="text" readonly="true" class="form-control" id="discount_percent" value="{{$discount_percent}}%">
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div wire:ignore>
                            <label>About Product (optional)</label>
                            <textarea id="about_product" class="form-control summernote-area" wire:model.lazy="about_product"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div wire:ignore>
                            <label>Other Details (optional)</label>
                            <textarea id="other_details" class="form-control summernote-area" wire:model.lazy="other_details"></textarea>
                        </div>
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
                                    @if(!empty($photos))
                                        @foreach($photos as $key => $photo)
                                            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                                                <div class="card overflow-hidden @if($key == $featured_photo) sayang-featured-photo-bordered @else sayang-photo-bordered @endif">
                                                    <div class="position-relative">
                                                        <img src="{{$photo->temporaryUrl()}}" class="sayang-card-photo" alt="Product Photo">
                                                        @if($key == $featured_photo)
                                                            <div class="sayang-featured-photo-overlay">Featured</div>
                                                        @else
                                                            <button type="button" class="btn btn-warning btn-sm sayang-set-featured-photo-overlay" title="Set as Featured" wire:click="apply_featured_photo('{{$key}}')">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        @endif
                                                        <button type="button" class="btn btn-danger btn-sm sayang-remove-photo-overlay" title="Remove" onclick="remove_photo('{{$key}}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 offset-sm-4">
                                        <div wire:loading wire:target="photos" class="text-success">
                                            <span class="fas fa-spinner fa-spin"></span> Uploading Please Wait...
                                        </div>
                                        <div wire:loading wire:target="apply_featured_photo" class="text-success">
                                            <span class="fas fa-spinner fa-spin"></span> Applying Featured Photo
                                        </div>
                                        <div class="form-group">
                                            <label for="photos">Upload Photos*</label>
                                            <!-- <input type="file" id="photos" class="form-control-file @error('photos.*') is-invalid @enderror" accept=".jpg, .jpeg, .png" wire:model="photos" multiple="true"> -->
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="photos" accept=".png, .jpeg, .jpg, .gif, .docx, .pdf" wire:model="photos" multiple>
                                                    <label class="custom-file-label" for="photos">
                                                        @if($photos) 
                                                            @if(count($this->photos) > 0)
                                                                {{count($this->photos)}} Photos Selected 
                                                            @else
                                                                No Photo Selected
                                                            @endif    
                                                        @else 
                                                            No Photo Selected 
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <small>File Size: Maximum of 1MB</small>
                                            </div>
                                            <div>
                                                <small>File Extension: .png, .jpeg, .jpeg</small>
                                            </div>
                                            @if(empty($photos))
                                                @error('photos')
                                                    <span class="invalid-feedback d-block">
                                                        <span>{{$message}}</span>
                                                    </span>
                                                @enderror
                                            @else
                                                @error('photos.*')
                                                    <span class="invalid-feedback d-block">
                                                        <span>{{$message}}</span>
                                                    </span>
                                                @enderror
                                            @endif
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
            <button wire:target="photos, store" wire:loading.attr="disabled" type="submit" class="btn btn-warning float-right w-100">
                Add this Product <span wire:loading wire:target="store" class="fas fa-spinner fa-spin"></span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (event) {
        var toolbar = [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
        ]

        $('#about_product').summernote({
            toolbar : toolbar,
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('about_product', contents)
                }
            },
            height: 300, 
            placeholder: 'About product here...'
        });

        $('#other_details').summernote({
            toolbar : toolbar,
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('other_details', contents)
                }
            },
            height: 300, 
            placeholder: 'Other details here...'
        });

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
            @this.call('compute_price_percentage')
        });
        $(document).on('keyup', '#regular_price', function () {
            @this.set('regular_price', $(this).val())
            @this.call('compute_price_percentage')
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
        $('#sub_categories').select2(select2_child_input(data, false, "Select"));
    });

    window.livewire.on('money_input_field', param => {
        for(var key in param){
            $('#'+key).val(param[key]);
        }
    });

    function remove_photo(key){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
                @this.call('remove_photo', key)
            }
        })
    }
</script>
@endpush