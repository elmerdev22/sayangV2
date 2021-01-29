<div>
    <div class="row pt-3 pb-1">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Sayang</a></li>
                    <li class="breadcrumb-item"><a href="#">Categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$category ? $category : 'All'}}</li>
                    @if ($sub_category)
                        <li class="breadcrumb-item active" aria-current="page">{{$sub_category ? $sub_category : ''}}</li> 
                    @endif
                </ol>
            </nav>
        </div>
    </div>
</div>
@push('scripts')
<script>
    window.livewire.on('change_url', url => {
        history.pushState(null, null, url);
    });
</script>   
@endpush
