<div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">Bid</th>
                            <th scope="col">Qty</th>
                            <th scope="col" width="100" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bid as $key => $data)
                        <tr>
                            <td>₱{{number_format($data->bid, 2)}}</td>
                            <td>{{number_format($data->quantity, 0)}}</td>
                            <td>
                                <button class="btn btn-danger btn-xs" onclick="delete_selected('{{$data->id}}', '{{number_format($data->bid, 2)}}')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">No Bids already.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if ($bid->total() > 0)
        <div class="row">
            <div class="col-md-6">        
                <div class="float-left">
                    {{$bid->render()}}
                </div>
            </div>
            <div class="col-md-6">        
                <button type="button" class="btn btn-danger float-right" onclick="delete_all()" >Delete all</button>
            </div>
        </div>
    @endif
</div>
@push('scripts')
<script>
    function delete_all(){
        Swal.fire({
        title: 'Are you sure you want to delete all?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `Confirm`,
        reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('delete_all')
            } 
        })
    }
    function delete_selected( id, bid){
        Swal.fire({
        title: 'Are you sure you want to delete this bid? ₱'+bid,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: `Confirm`,
        reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('delete_selected', id)
            } 
        })
    }
</script>   
@endpush
