<div>
    @forelse($data as $row)
        <div class="post clearfix">
            <div class="user-block">
                <img class="img-circle img-bordered-sm mr-3 lazy" style="width: 50px; height: 50px;" src="{{UploadUtility::account_photo($row->user_account->key_token, 'profile-picture', 'profile')}}" alt="User Image">
                    <span class="username">
                        <a href="#">{{$row->user_account->first_name}} {{$row->user_account->last_name}}</a>
                        <a href="#" class="float-right btn-tool">{{Utility::carbon_diff($row->created_at)}}</a>
                    </span>
                <span class="description">
                    @php $star = $row->star @endphp
                    @for ($s = 0; $s < $star ; $s++)
                        <span class="fas fa-star text-warning"></span>
                    @endfor
                    @for ($n = $star; $n < 5 ; $n++)
                        <span class="fas fa-star"></span>
                    @endfor
                </span>
            </div>
            <!-- /.user-block -->
            <p class="w-100">
                {{$row->comment}}
            </p>
            <p>
                @php
                    $rating = explode(',', $row->rating)    
                @endphp
                <h5>
                    @foreach ($rating as $item)
                        <span class="badge badge-default border">{{$item}}</span>
                    @endforeach
                </h5>
            </p>
            @php $pic = rand(1,5) @endphp
        </div>
        <!-- /.card-comment -->
    @empty 
    <p>
        No Ratings Yet.
    </p>
    @endforelse
    @if ($data->total() > 5 && $data->total() > $show)
        <div class="row float-right mt-3">
            <button class="btn btn-warning" wire:click="load_more">Load more <span class="fas fa-chevron-right"></span></button>
        </div>
    @endif
</div>
