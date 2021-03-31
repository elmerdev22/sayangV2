<div>
    <div class="card card-outline card-sayang mb-3">
        <div class="card-header">
            <h5 class="card-title">Activity</h5> 
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <a class="float-right cursor-pointer" wire:click="read_all()"><u>Mark all as read</u></a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover table-sm table-cell-nowrap text-center">
                    <thead>
                        <tr>
                            <th>Activity</th>
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

                            <tr style="background-color:  {{$row->is_read == 0 ? 'whitesmoke': ''}} ; cursor: pointer;">
                                <td>
                                    <a target="_blank" 
                                        @if ($row->product_post_id != null) 
                                            @if ($row->type == 'partner_product_post_end')
                                                href="{{route('front-end.partner.activities.past_details', ['slug' => $row->product_post->product->slug ,'key_token' => $row->product_post->key_token] )}}" 
                                            @else 
                                                href="javascript:void(0);";
                                            @endif 
                                        @endif 
                                        @if ($row->is_read == 0)
                                            wire:click="click('{{$row->id}}')"
                                        @endif
                                    >
                                
                                        <div class="media pt-2">
                                            <img src="{{$featured_photo}}" class="img-size-50 mr-3 img-circle" style="height: 45px;">
                                            <div class="media-body text-left">
                                                <h3 class="dropdown-item-title">
                                                    {{$row->web_notification_settings->title}}
                                                    <small class="float-right text-muted">{{Utility::carbon_diff($row->created_at)}}</small>
                                                </h3>
                                                <p class="text-sm">{{$row->web_notification_settings->message}}</p>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">No Notifications.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- NOTE: Always put the pagination after the .table-responsive class -->
            @include('front-end.includes.datatables.pagination', ['pagination_items' => $data])
        </div>
    </div> <!-- card.// -->
</div>
