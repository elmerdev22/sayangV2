<div>
    <div class="row">
        @for ($i = 1; $i < 6; $i++)
        <div class="col-md-4">
            <div class="card card-outline card-sayang mb-3">
                <div class="card-header">
                    <h5 class="card-title"> 
                        @for ($s = 0; $s < $i; $s++)
                         <span class="fas fa-star text-warning"></span>
                        @endfor
                        @for ($n = $i; $n < 5 ; $n++)
                            <span class="fas fa-star"></span>
                        @endfor
                    </h5> 
                    <div class="card-tools">
                        <button class="btn btn-warning btn-xs" onclick="add('{{$i}}')"><span class="fas fa-plus"></span> Ratings</button>
                    </div>
                </div>
                <div class="card-body">
                    <h5>
                        @forelse ($data as $row)
                            @if ($row->star == $i)
                                <span class="badge badge-default border m-1">
                                    {{ucfirst($row->rating)}} <span class="fas fa-times text-danger cursor-pointer" onclick="delete_rating('{{$row->id}}')"></span> 
                                </span>
                            @endif
                        @empty
                            <span> No rating yet.</span>
                        @endforelse
                    </h5>
                </div>
            </div>
        </div>
        @endfor
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="add-ratings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form role="form" wire:submit.prevent="save">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @for ($c = 0; $c < $star; $c++)
                            <span class="fas fa-star text-warning"></span>
                            @endfor
                            @for ($z = $star; $z < 5 ; $z++)
                                <span class="fas fa-star"></span>
                            @endfor
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Rating</label>
                            <input type="text" class="form-control" placeholder="Input here..." wire:model.lazy="rating">
							@error('rating')
				                <span class="invalid-feedback" style="display: block;">
				                    <span>{{$message}}</span>
				                </span> 
				            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                    <button type="submit" class="btn btn-warning">Submit <span wire:loading wire:target="save" class="fas fa-spinner fa-spin"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function add(star){
        @this.call('add', star)
        $('#add-ratings').modal('show');
    }
    function delete_rating(id){
        Swal.fire({
            title: 'Are you sure you want to Delete?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Confirm`,
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('delete', id)
            } 
        })
    }
</script>    
@endpush