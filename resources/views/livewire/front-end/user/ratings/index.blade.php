<div>
    <!-- PArtner Rate Modal -->
    <div wire:ignore.self class="modal fade" id="rate-seller-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="submit">
                    <div class="modal-header">
                        <h6 class="modal-title">Rate This Seller<span id="modal-qr_code_order_no"></span></h6>
                    </div>
                    <div class="modal-body text-center">
                        <div class="row">
                            <div class="col-12">
                                <img class="profile-user-img img-fluid img-circle m-2" src="{{$store_photo}}" alt="User profile picture" style="width: 120px; height: 120px;">
                            </div>
                            <div class="col-12">
                                <h5>{{$seller_name}}</h5>
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
                            <div class="col-md-6">
                                @foreach ($data as $item)
                                    <div class="form-group" wire:ignore.self>
                                        <label class="float-left custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input cursor-pointer" id="rate-{{$item->id}}" onclick="rate('{{$item->id}}')" data-value="{{$item->rating}}"> 
                                        <div class="custom-control-label"> {{$item->rating}} </div> </label>
                                    </div> <!-- form-group form-check .// -->
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
                        <button type="submit" class="btn btn-primary">Submit <span wire:loading wire:target="submit" class="fas fa-spinner fa-spin"></span></button>
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
        var selected = $('#rate-'+id);
        var value = $(selected).data('value');
        if($(selected).prop("checked") == true){
            console.log("Checkbox is checked.");
            select_array.push(value);
        }
        else if($(selected).prop("checked") == false){
            console.log("Checkbox is unchecked.");
            select_array.splice( $.inArray(value, select_array), 1 );
        }
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
            select_array = [];
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
    
    window.livewire.on('close_modal', param => {
        $('#rate-seller-modal').modal('hide');
        select_array = [''];
    });
</script>
@endsection