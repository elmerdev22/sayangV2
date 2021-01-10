<div>
    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
        <i class="far fa-bell"></i>
        @if ($data->count() > 0 )
            <span class="badge badge-warning navbar-badge">{{number_format($data->count(),0)}}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right" style="left: inherit; right: 0px;">
        <span class="dropdown-item dropdown-header bg-white">{{number_format($data->count(),0)}} New Notifications</span>
        <div class="dropdown-divider"></div>
            <div class="scrollable-menu">
                @forelse($data as $row)
                @php
                    if($row->product_post_id == null){
                        $featured_photo = 'https://www.flaticon.com/svg/static/icons/svg/1827/1827370.svg';
                    }
                    else{
                        $user_account_token = $row->product_post->product->partner->user_account->key_token;
                        $product_token      = $row->product_post->product->key_token;
                        $featured_photo     = UploadUtility::product_featured_photo($user_account_token, $product_token)[0]->getFullUrl('thumb');
                    }
                @endphp
                
                <a target="_blank" 
                    @if ($row->product_post_id != null)
                        @if ($row->type == 'partner_product_post_end')
                            href="{{route('front-end.partner.my-products.activities.past', ['slug' => $row->product_post->product->slug ,'key_token' => $row->product_post->key_token] )}}" 
                        @else 
                            href="javascript::void()";
                        @endif 

                    @else
                        @if($row->type == 'new_product_sold')
                            href="{{route('front-end.partner.order-and-receipt.to-receive')}}" 
                        @elseif($row->type == 'new_cop_request')
                            href="{{route('front-end.partner.order-and-receipt.order-placed')}}" 
                        @else 
                            href="javascript::void()";
                        @endif 
                    @endif

                    wire:click="click('{{$row->id}}')" class="dropdown-item">
                    
                        <div class="media">
                            <img src="{{$featured_photo}}" class="img-size-50 mr-3 img-circle" style="height: 35px; width: auto;">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    {{Str::limit($row->web_notification_settings->title, 20, '...')}}
                                    <small class="float-right text-muted">{{Utility::carbon_diff($row->created_at)}}</small>
                                </h3>
                                <p class="text-sm">{{Str::limit($row->web_notification_settings->message, 35, '...')}}</p>
                            </div>
                        </div>
                    </a>
                <div class="dropdown-divider"></div>
                @empty
                    <a href="javascript::void()" class="dropdown-item text-center">
                        No new notifications.
                    </a>
                @endforelse
            </div>
        <div class="dropdown-divider"></div>
        <a href="{{route('front-end.partner.notifications.activity')}}" class="dropdown-item dropdown-footer">See All Messages</a>
    </div>
</div>
