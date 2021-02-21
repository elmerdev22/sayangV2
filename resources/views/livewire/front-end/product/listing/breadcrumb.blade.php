<div>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-white-50">Sayang</a></li>
            <li class="breadcrumb-item"><a href="{{route('front-end.product.list.index')}}" class="text-white-50">Products</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">{{$category ? $category : 'All'}}</li>
            @if ($sub_category)
                <li class="breadcrumb-item active" aria-current="page">{{$sub_category ? $sub_category : ''}}</li> 
            @endif
        </ol>
    </nav>
</div>
@push('scripts')
<script>
    window.livewire.on('change_url', url => {
        history.pushState(null, null, url);
    });
</script>   
@endpush
