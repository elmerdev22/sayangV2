<div>
    <article class="accordion mb-4" id="accordion_pickup_option">
        @foreach (Utility::pickup_options() as $key => $value)
            <div class="card m-0">
                <header class="card-header">
                    <label class="form-check" aria-expanded="true">
                        <input class="form-check-input" name="pickup-option" 
                            {{$pickup_option == $key ? 'checked':'' }} 
                            @if($pickup_option != $key) 
                                wire:click="change_pickup_option('{{$key}}')" 
                            @endif
                            type="radio"
                            value="{{$key}}"
                        >
                        <h6 class="form-check-label"> 
                            {{$value}}
                        </h6>
                    </label>
                </header>
            </div> <!-- card.// -->
        @endforeach
    </article>
</div>
