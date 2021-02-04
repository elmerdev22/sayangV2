<div>

    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">Banks List</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-add_bank">
                    <i class="fas fa-plus"></i> Add New
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    @forelse($data as $row)
                        <blockquote class="@if($row->is_active) quote-warning @else quote-secondary @endif">
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
                                    <button type="button" class="btn btn-sm btn-primary" title="Edit" onclick="edit('{{$row->key_token}}')">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" title="Delete" onclick="delete_bank('{{$row->key_token}}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @if(!$row->is_active)
                                        <span class="badge badge-danger">Not Active</span>
                                    @else
                                        <span class="badge badge-success">Active</span>
                                    @endif
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
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('initialize_banks', param => {
        $('#modal-add_bank').modal('hide');
        $('#modal-edit_bank').modal('hide');
        if(param == true){
            Swal.close();
        }
    });
    window.livewire.on('initialize_edit_bank', param => {
        setTimeout(function (){
            $('#modal-edit_bank').modal('show');
            Swal.close();
        }, 2000);
    });
    

    function delete_bank(key_token){
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
    
    function edit(key_token){
        Swal.fire({
            title             : 'Please wait...',
            html              : 'Getting Information...',
            allowOutsideClick : false,
            showCancelButton  : false,
            showConfirmButton : false,
            onBeforeOpen      : () => {
                Swal.showLoading();
                @this.call('edit', key_token)
            }
        });
    }

</script>
@endpush