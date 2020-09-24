<div class="col-md-12 d-flex justify-content-end">
    <button class="btn @if($status == 0 ) btn-danger @else btn-success @endif btn-sm" onclick="block({{$status}})">{{($status == 0 ? 'Blocked': 'Unblocked').' User'}}</button>
</div>
@push('scripts')
<script type="text/javascript">
    function block(status){
        if(status == 1){
            message = 'Unblocked';
        }
        else{
            message = 'Blocked';
        }
        Swal.fire({
            title: `Are you sure, do you want to ${message}?`,
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                // If true
                @this.call('block');

            }
        })
    }
</script>
@endpush