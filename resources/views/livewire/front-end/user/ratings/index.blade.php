<div>
    <!-- PArtner Rate Modal -->
    <div wire:ignore.self class="modal fade" id="rate-seller-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="submit">
                    <div class="modal-header">
                        <h5 class="modal-title">Rate This Seller<span id="modal-qr_code_order_no"></span></h5>
                    </div>
                    <div class="modal-body text-center">
                        <div class="row">
                            <div class="col-12">
                                <img class="profile-user-img img-fluid img-circle m-2" src="{{asset('images/default-photo/store.png')}}" alt="User profile picture" style="width: 120px; height: 120px;">
                            </div>
                            <div class="col-12">
                                <h5>Seller name</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- Rating Stars Box -->
                                <div wire:ignore class='rating-stars text-center'>
                                    <ul id='stars'>
                                        <li class='star' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                @foreach ($data as $item)
                                    <a wire:ignore.self class="btn btn-default btn-sm m-1 cursor-pointer" id="rate-{{$item->id}}" onclick="rate('{{$item->id}}')" data-value="{{$item->id}}">{{$item->rating}}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <textarea class="form-control" placeholder="Comment here..." wire:model.lazy="comment"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Skip</button>
                        <button type="submit" class="btn btn-warning">Submit <span wire:loading wire:target="submit" class="fas fa-spinner fa-spin"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('js')
<script>
    var select_array = [];

    function rate(id){
        select_array = []
        var selected = $('#rate-'+id);

        if(selected.hasClass('btn-outline-warning')){
            selected.removeClass('btn-outline-warning').addClass('btn-default');
        }
        else{
            selected.removeClass('btn-default').addClass('btn-outline-warning');
        }
        $( ".btn-outline-warning" ).each(function( index ) {
            var id = $( this ).data('value');
            if($.isNumeric(id)){
                select_array.push(id);
            }
        });
        console.log(select_array);
        @this.set('rating', select_array )

    }
    $(document).ready(function(){
        var starthis = $('#stars li');
        var onStar = parseInt({{$star}}, 10); // The star currently selected
        var stars = starthis.parent().children('li.star');
        
        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }
        
        /* 2. Action to perform on click */
        $('#stars li').on('click', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');
            
            for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
            }
            
            for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
            }
            
            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            responseMessage(ratingValue);
            
        });
        
    });

    function responseMessage(ratingValue) {
        @this.set('rating', [])
        @this.set('star', ratingValue )
    }
</script>
@endsection