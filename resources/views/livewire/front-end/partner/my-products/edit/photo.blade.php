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
                                @if(count($media_photos) > 0)
                                    <button type="button" class="btn btn-danger btn-sm sayang-remove-photo-overlay" title="Remove" onclick="remove_photo('{{$key}}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
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
                                <button type="button" class="btn btn-warning btn-sm sayang-set-featured-photo-overlay" title="Set as Featured" wire:click="apply_featured_photo('{{$key}}')">
                                    <i class="fas fa-check"></i>
                                </button>
                                @if(count($media_photos) > 0)
                                    <button type="button" class="btn btn-danger btn-sm sayang-remove-photo-overlay" title="Remove" onclick="remove_photo('{{$key}}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
