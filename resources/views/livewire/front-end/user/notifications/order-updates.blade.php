<div>
    <div class="card">
        <header class="card-header">
            <strong class="d-inline-block mr-3">Order Updates</strong>
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
                        <tr class="border">
                            <th colspan="3" class="text-center">Order Updates</th>
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
                                    $featured_photo     = UploadUtility::product_featured_photo($user_account_token, $product_token, true);
                                }
                            @endphp

                                <tr class="clickable-row border"
                                    @if ($row->product_post_id != null) 
                                        data-href="{{route('front-end.product.information.redirect', ['slug' => $row->product_post->product->slug, 'key_token' => $row->product_post->key_token, 'type' => 'buy_now'])}}" 
                                    @else 
                                        @if($row->type == 'cancelled_cop_request')
                                            data-href="{{route('front-end.user.my-purchase.cancelled')}}"
                                        @elseif($row->type == 'confirmed_cop_request')
                                            data-href="{{route('front-end.user.my-purchase.to-receive')}}"
                                        @elseif($row->type == 'order_completed')
                                            data-href="{{route('front-end.user.my-purchase.completed')}}"
                                        @else 
                                            data-href="#";
                                        @endif 
                                    @endif 
                                    @if ($row->is_read == 0)
                                        wire:click="click('{{$row->id}}')"
                                    @endif
                                    class="border" style="background-color:  {{$row->is_read == 0 ? 'whitesmoke': ''}} ; cursor: pointer;">
                                    <td>
                                        <img src="{{$featured_photo}}" class="img-xs">
                                    </td>
                                    <td class="text-left"> 
                                        <p class="title mb-0">{{$row->web_notification_settings->title}}</p>
                                        <small class="text-muted">
                                            @if ($row->product_post_id != null)
                                                @php
                                                    $message = str_replace('{product}', $row->product_post->product->name, $row->web_notification_settings->message);    
                                                @endphp
                                            @else 
                                                @php
                                                    $message = $row->web_notification_settings->message;    
                                                @endphp
                                            @endif
                                            {{$message}}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="text-muted text-sm float-right">{{Utility::carbon_diff($row->created_at)}}</span>
                                    </td>
                                </tr>
                        @empty
                            <tr class="border">
                                <td colspan="1">
                                    <p class="text-center">No Notifications.</p>
                                </td>
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