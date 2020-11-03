<div>
    <div class="row">
        <div class="col-12">
            @forelse($data as $row)
                <blockquote class="@if($row->is_default) quote-warning @else quote-secondary @endif">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div title="Card Holder Name">
                                <span class="fas fa-user"></span> {{ucwords($row->card_holder)}}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div title="Card No.">
                                <span class="fas fa-credit-card"></span> {{$row->card_no}}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <div title="CVV">
                                <span class="fas fa-key"></span> {{$row->card_verification_value}}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            @if(!$row->is_default)
                                <button type="button" class="btn btn-sm btn-default" onclick="set_default('{{$row->key_token}}')">Set Default</button>
                            @else
                                <button type="button" class="btn btn-sm btn-info" disabled="true">
                                    &nbsp;&nbsp; Default &nbsp;&nbsp;
                                </button>
                            @endif
                            <!-- <button type="button" class="btn btn-sm btn-primary" title="Edit" onclick="edit('{{$row->key_token}}')">
                                <i class="fas fa-pen"></i>
                            </button> -->
                            <button type="button" class="btn btn-sm btn-danger" title="Delete" onclick="delete_data('{{$row->key_token}}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </blockquote>
            @empty
                <p class="text-center">You don't have credit card yet.</p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right">
            {{$data->links()}}
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('credit_card_initialize', param => {
        $('#modal-add_credit_card').modal('hide');
    });

    function delete_data(key_token){
        Swal.fire({
            title: 'Are you sure do you want to delete this credit card?',
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
                    html              : 'Deleting Credit Card...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('delete', key_token)
                    }
                });
            }
        })
    }

    function set_default(key_token){
        Swal.fire({
            title: 'Are you sure do you want to set this as default credit card?',
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
                    html              : 'Updating Credit Card...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('set_default', key_token)
                    }
                });
            }
        })
    }
</script>
@endpush