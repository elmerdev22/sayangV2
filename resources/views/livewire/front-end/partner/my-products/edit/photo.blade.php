<div>
    <div class="card-body">
        <div class="row">
            @if(!empty($featured_photo))
                @foreach($featured_photo as $key => $photo)
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                        <div class="card overflow-hidden sayang-featured-photo-bordered">
                            <div class="position-relative">
                                <img src="{{$photo->getFullUrl('thumb')}}" class="sayang-card-photo" alt="Product Photo">
                                <div class="sayang-featured-photo-overlay">Featured</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            @if(!empty($media_photos))
                @foreach($media_photos as $key => $photo)
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                        <div class="card overflow-hidden sayang-photo-bordered">
                            <div class="position-relative">
                                <img src="{{$photo->getFullUrl('thumb')}}" class="sayang-card-photo" alt="Product Photo">
                                <button type="button" class="btn btn-warning btn-sm sayang-set-featured-photo-overlay" title="Set as Featured" onclick="update_featured('{{$key}}')">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm sayang-remove-photo-overlay" title="Remove" onclick="delete_photo('{{$key}}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    function delete_photo(key){
        Swal.fire({
            title: 'Are you sure do you want to delete this photo?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // If true
                Swal.fire({
                    title             : 'Please wait...',
                    html              : 'Deleting Photo...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('delete', key)
                    }
                });
            }
        })
    }
    function update_featured(key){
        Swal.fire({
            title: 'Are you sure do you want to apply this as featured photo?',
            // text: "You won't be able to revert this!",
            // icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // If true
                Swal.fire({
                    title             : 'Please wait...',
                    html              : 'Updating Featured Photo...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('update_featured', key)
                    }
                });
            }
        })
    }
</script>
@endpush