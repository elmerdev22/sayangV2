<div>
    <div class="user-panel sayang-user-panel mt-1 pb-1 pt-1 mb-3 d-flex">
        <div class="image" title="Profile">
            <a href="{{route('front-end.partner.my-account.index')}}">
                <img src="{{$photo}}" class="img-circle elevation-1" alt="User Image" style="width: 2.1rem; height: 2.1rem;">
            </a>
        </div>
        <div class="info block-element w-100" title="Profile">
            <a href="{{route('front-end.partner.my-account.index')}}" class="d-block">{{ucwords($account->first_name.' '.$account->last_name)}}</a>
        </div>
    </div>
</div>
