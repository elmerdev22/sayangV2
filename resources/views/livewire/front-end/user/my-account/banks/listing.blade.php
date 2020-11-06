<div>
    <div class="row">
        <div class="col-12">
            @forelse($data as $row)
                <blockquote class="@if($row->is_default) quote-warning @else quote-secondary @endif">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div>
                                <span class="fas fa-building"></span> <strong>{{$row->bank->name}}</strong> 
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div title="Account Name">
                                <span class="fas fa-user"></span> {{ucwords($row->account_name)}}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div title="Account No.">
                                <span class="fas fa-credit-card"></span> {{$row->account_no}}
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
                <p class="text-center">You don't have bank account yet.</p>
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
    window.livewire.on('banks_initialize', param => {
        $('#modal-add_bank').modal('hide');
    });

    function delete_data(key_token){
        Swal.fire({
            title: 'Are you sure do you want to delete this bank account?',
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
                    html              : 'Deleting Bank Account...',
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
            title: 'Are you sure do you want to set this as default bank account?',
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
                    html              : 'Updating Bank Account...',
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