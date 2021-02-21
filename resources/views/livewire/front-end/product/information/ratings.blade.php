<div>
    <!-- ============================ COMPONENT 1 ================================= -->
    <div class="row">
        <div class="col-md-12">
            <article class="box mb-3">
                <header class="section-heading">
                    <h5>Ratings <strong class="label-rating"> {{Utility::get_partner_ratings($partner_id)}} <span class="text-muted">| {{number_format($data->total() ,0)}} reviews</span></strong></h5>  
                    
                </header>
                @forelse($data as $row)
                <hr>
                <div class="icontext w-100 padding-y-sm">
                    <img src="{{UploadUtility::account_photo($row->user_account->key_token, 'profile-picture', 'profile')}}" class="img-xs icon rounded-circle">
                    <div class="text">
                        <span class="date text-muted float-md-right">{{Utility::carbon_diff($row->created_at)}}</span>  
                        <h6 class="mb-1">{{$row->user_account->first_name}} {{$row->user_account->last_name}}</h6>
                            @php $star = $row->star @endphp
                            @for ($s = 0; $s < $star ; $s++)
                                <span class="fas fa-star text-warning"></span>
                            @endfor
                            @for ($n = $star; $n < 5 ; $n++)
                                <span class="fas fa-star"></span>
                            @endfor
                            
                            @php
                                $rating = explode(',', $row->rating)    
                            @endphp
                                
                            @foreach ($rating as $item)
                                <span class="badge badge-default border">{{$item}}</span>
                            @endforeach
                    </div>
                </div> <!-- icontext.// -->
                <div class="mt-3">
                    <p>
                        Dummy comment Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip
                    </p>	
                </div>
                @empty 
                <p>
                    No Ratings Yet.
                </p>
                @endforelse
                
                @if ($data->total() > 5 && $data->total() > $show)
                <div class="pt-5">
                    <button class="btn btn-primary float-right" wire:click="load_more">Load more <span wire:target="load_more" wire:loading.class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span></button>
                </div>
                @endif
            </article>
            
        </div> <!-- col.// -->
    </div> <!-- row.// -->
    <!-- ============================ COMPONENT 1 END .// ================================= -->
</div>
