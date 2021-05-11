<div>
	<div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">Featured Partners</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h6>Featured Partner List (max 4 partners only)</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Partners</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($featured_partners as $partner)
                                    <tr>
                                        <td>
                                            @if($partner->name) 
                                                {{ucfirst($partner->name)}} 
                                            @else 
                                                <i class="text-danger">not set</i> 
                                            @endif
                                        </td>
                                        <td>
                                            @if ($partner->is_featured)
                                                <button class="btn btn-danger btn-sm" onclick="action('{{$partner->id}}', '0')">Deselect</button>
                                            @else 
                                                <button class="btn btn-default btn-sm mr-1" disabled>Selected</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No Partner Selected.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <h6>Partner Lists</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- NOTE: Always put the show entries & search before the .table-responsive class -->
                    @include('back-end.layouts.includes.datatables.search')
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm text-center">
                            <thead>
                                <tr>
                                    <th class="table-sort" wire:click="sort('partners.name')">
                                        Partner Name 
                                        @include('back-end.layouts.includes.datatables.sort', ['field' => 'partners.name'])
                                    </th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $partner)
                                    <tr>
                                        <td>
                                            @if($partner->name) 
                                                {{ucfirst($partner->name)}} 
                                            @else 
                                                <i class="text-danger">not set</i> 
                                            @endif
                                        </td>
                                        <td>
                                            @if ($partner->is_featured)
                                                <button class="btn btn-default btn-sm mr-1" disabled>Selected</button>
                                                <button class="btn btn-danger btn-sm" onclick="action('{{$partner->id}}', '0')">Deselect</button>
                                            @else 
                                                <button class="btn btn-primary btn-sm" onclick="action('{{$partner->id}}', '1')">Select</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No Data Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- NOTE: Always put the pagination after the .table-responsive class -->
                    @include('back-end.layouts.includes.datatables.pagination', ['pagination_items' => $data])
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    
    function action(partner_id, bool){
        var action_name = bool == '0' ? 'Deselect' : 'Select';
        Swal.fire({
            title: 'Are you sure do you want to '+action_name+' this featured partner ?',
            text: "You won't be able to revert this!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // If true
                Swal.fire({
                    title             : 'Please wait...',
                    html              : 'Updating ...',
                    allowOutsideClick : false,
                    showCancelButton  : false,
                    showConfirmButton : false,
                    onBeforeOpen      : () => {
                        Swal.showLoading();
                        @this.call('action', partner_id, bool)
                    }
                });
            }
        })
    }
    window.livewire.hook('afterDomUpdate', () => {
		Swal.close();
    });
</script>
@endpush