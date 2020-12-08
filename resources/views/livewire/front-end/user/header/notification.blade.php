<div>
    <a href="#" class="widget-view" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-tooltip="Notifications" data-tooltip-location="bottom">
        <div class="icon-area">
            <i class="fas fa-bell text-dark" id="notif"></i>
            <span class="notify"><span class="badge badge-warning">{{number_format($data->count(),0)}}</span></span>
        </div>
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
                
                <a  @if ($row->product_post_id != null) 
                        @if ($row->type == 'bidder_won')
                            href="{{route('front-end.user.my-bids.win')}}"
                        @elseif($row->type == 'bidder_lose')
                            href="{{route('front-end.user.my-bids.lose')}}"
                        @else 
                            href="#";
                        @endif 
                    @endif 
                class="dropdown-item" 
                wire:click="click('{{$row->id}}')">
                
                        <div class="media">
                            <img src="{{$featured_photo}}" class="img-size-50 mr-3 img-circle" style="height: 45px;">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    {{Str::limit($row->web_notification_settings->title, 18, '...')}}
                                    <small class="float-right text-muted">{{Utility::carbon_diff($row->created_at)}}</small>
                                </h3>
                                <p class="text-sm">{{Str::limit($row->web_notification_settings->message, 35, '...')}}</p>
                            </div>
                        </div>
                    </a>
                <div class="dropdown-divider"></div>
                @empty
                    <a href="#" class="dropdown-item text-center">
                        No new notifications.
                    </a>
                @endforelse
            </div>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
    </div>
</div>
{{-- @push('scripts')
<script>
  window.livewire.on('notifications', message => {
      $( "#notif" ).effect( "shake", { times: 2, distance: 5}, 500 );
      $( "#NotifSound")[0].play()
  });

</script>
@endpush --}}

{{-- <audio id="NotifSound">
  <source src="{{asset('sounds/notification.mp3')}}" type="audio/mpeg">
</audio> --}}