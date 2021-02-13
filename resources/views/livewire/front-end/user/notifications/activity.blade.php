<div>
    <div class="card">
        <header class="card-header">
            <strong class="d-inline-block mr-3">Activity</strong>
        </header>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <a href="javascript:void(0);" class="float-right" wire:click="read_all()"><u>Mark all as read</u></a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover table-borderless table-cell-nowrap text-center">
                    <thead>
                        <tr>
                            <th class="text-center">Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $row)
                        
                            @php
                                if($row->product_post_id == null){
                                    $featured_photo = asset('images/default-photo/notification-icon.png');
                                }
                                else{
                                    $user_account_token = $row->product_post->product->partner->user_account->key_token;
                                    $product_token      = $row->product_post->product->key_token;
                                    $featured_photo     = UploadUtility::product_featured_photo($user_account_token, $product_token)[0]->getFullUrl('thumb');
                                }
                            @endphp

                            <tr class="clickable-row border"
                                @if ($row->product_post_id != null) 
                                    @if ($row->type == 'bidder_won')
                                        data-href="{{route('front-end.user.my-bids.win')}}"
                                    @elseif($row->type == 'bidder_lose')
                                        data-href="{{route('front-end.user.my-bids.lose')}}"
                                    @elseif($row->type == 'partner_new_product_post')
                                        data-href="{{route('front-end.product.information.redirect', ['slug' => $row->product_post->product->slug , 'key_token' => $row->product_post->key_token , 'type' => 'buy_now'])}}"
                                    @else 
                                        data-href="#";
                                    @endif 
                                @endif 
                                @if ($row->is_read == 0)
                                    wire:click="click('{{$row->id}}')"
                                @endif
                                style="background-color:  {{$row->is_read == 0 ? 'whitesmoke': ''}} ; cursor: pointer;">
                                <td>
                                    <img src="{{$featured_photo}}" class="img-xs">
                                </td>
                                <td class="text-left"> 
                                    <p class="title mb-0">{{$row->web_notification_settings->title}}</p>
                                    <small class="text-muted">{{$row->web_notification_settings->message}}</small>
                                </td>
                                <td>
                                    <span class="text-muted text-sm float-right">{{Utility::carbon_diff($row->created_at)}}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="1">No Notifications.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- NOTE: Always put the pagination after the .table-responsive class -->
            @include('front-end.includes.datatables.pagination', ['pagination_items' => $data])
        </div>
    </div>
</div>

@push('scripts')
<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.open($(this).data("href"));
        });
    });
</script>   
@endpush

