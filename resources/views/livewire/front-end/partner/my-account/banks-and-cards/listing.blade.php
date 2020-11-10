<div>
    @forelse($my_banks as $row)
        <blockquote class="@if($row->is_default) quote-warning @else quote-secondary @endif">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div>
                        <span class="fas fa-building-o"></span> <strong>{{$row->bank->name}}</strong> 
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
                    <button type="button" class="btn btn-sm btn-default" onclick="edit_modal('{{$row->key_token}}')">
                        <span class="fas fa-edit"></span> Edit
                    </button>
                    @if(!$row->is_default)
                        <button type="button" class="btn btn-sm btn-default">Set Default</button>
                    @else
                        <button type="button" class="btn btn-sm btn-default" disabled="true">Set Default</button>
                        <span class="badge badge-info">Default</span>
                    @endif
                </div>
            </div>
        </blockquote>
    @empty
        <p class="text-center">You don't have bank account yet.</p>
    @endforelse

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modal-edit_bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Bank Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="bank">Bank*</label>
                                            <select class="form-control" id="bank" wire:model="bank">
                                                <option value="">Select</option>
                                                @foreach($banks_list as $row)
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            
                                            @error('bank')
                                                <span class="invalid-feedback" style="display: block;">
                                                    <span>{{$message}}</span>
                                                </span> 
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="account_name">Account Name*</label>
                                            <input type="text" class="form-control text-capitalize" id="account_name" wire:model.lazy="account_name" placeholder="Enter Account Name">
                                            
                                            @error('account_name')
                                                <span class="invalid-feedback" style="display: block;">
                                                    <span>{{$message}}</span>
                                                </span> 
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="account_number">Account Number*</label>
                                            <input type="text" class="form-control" id="account_number" wire:model.lazy="account_number" placeholder="Enter Account Number">
                                            
                                            @error('account_number')
                                                <span class="invalid-feedback" style="display: block;">
                                                    <span>{{$message}}</span>
                                                </span> 
                                            @enderror
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">
                            Save Changes <span wire:loading wire:target="update" class="fas fa-spinner fa-spin"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function edit_modal(key_token){
        $('#modal-edit_bank').modal('show');
        @this.call('edit', key_token)
    }
</script>
@endpush

