<div>
    <button type="button" onclick="proceed()" class="btn btn-warning btn-block">Continue to checkout</button>
</div>

@push('scripts')
<script type="text/javascript">
    function proceed(){
        var card_dom = $('#card-billing');
        card_loader(card_dom, 'show');
        @this.call('proceed')
    }
</script>
@endpush