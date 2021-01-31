<div>
    <form action="POST" wire:submit.prevent="update">
        <div class="form-group row my-0">
            <label class="col-sm-4 col-form-label">Username</label>
            <div class="col-sm-8 col-form-label">{{$auth->name}}</div>
        </div>
        <div class="form-group row my-0">
            <label class="col-sm-4 col-form-label">Email Address</label>
            <div class="col-sm-8 col-form-label">{{$auth->email}}</div>
        </div>
        <div class="form-group row my-0">
            <label class="col-sm-4 col-form-label">Firstname</label>
            <div class="col-sm-8 col-form-label">
                <input type="text" class="form-control form-control-sm" wire:model.lazy="first_name">
                @error('first_name')
                    <span class="invalid-feedback" style="display: block;">
                        <span>{{$message}}</span>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row my-0">
            <label class="col-sm-4 col-form-label">Middlename</label>
            <div class="col-sm-8 col-form-label">
                <input type="text" class="form-control form-control-sm" wire:model.lazy="middle_name">
            </div>
        </div>
        <div class="form-group row my-0">
            <label class="col-sm-4 col-form-label">Lastname</label>
            <div class="col-sm-8 col-form-label">
                <input type="text" class="form-control form-control-sm" wire:model.lazy="last_name">
                @error('last_name')
                    <span class="invalid-feedback" style="display: block;">
                        <span>{{$message}}</span>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="form-group row my-0">
            <label class="col-sm-4 col-form-label">Contact Number</label>
            <div class="col-sm-8 col-form-label">
                <input type="text" class="form-control form-control-sm" wire:model.lazy="contact_no">
                @error('contact_no')
                    <span class="invalid-feedback" style="display: block;">
                        <span>{{$message}}</span>
                    </span>
                @enderror
            </div>
        </div>

        {{-- <div class="form-group row my-0">
            <label class="col-sm-4 col-form-label">Contact Number</label>
            @if($account->contact_no)
                <div class="col-sm-8 col-form-label">{{Utility::mobile_number_ph_format($account->contact_no)}}</div>
            @else
                <div class="col-sm-8 col-form-label">
                    <u>
                        <a href=""><span class="fas fa-plus"></span> Number</a>
                    </u>
                </div>
            @endif
        </div> --}}

        <div class="form-group row my-0">
            <label class="col-sm-4 col-form-label">Gender</label>
            <div class="col-sm-8 col-form-label">
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="male" value="male" wire:model="gender">
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="female" value="female" wire:model="gender">
                    <label class="form-check-label" for="female">Female</label>
                </div>
                @error('gender')
                    <span class="invalid-feedback" style="display: block;">
                        <span>{{$message}}</span>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row my-0">
            <label class="col-sm-4 col-form-label">Birth Date</label>
            <div class="col-sm-8 col-form-label">
                <input type="date" class="form-control form-control-sm" wire:model="birth_date">
                @error('birth_date')
                    <span class="invalid-feedback" style="display: block;">
                        <span>{{$message}}</span>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row my-0">
            <label class="col-sm-4 col-form-label">Joined Since</label>
            <div class="col-sm-8 col-form-label">{{date('F d, Y', strtotime($account->created_at))}}</div>
        </div>
        <div class="form-group mt-2">
            <button type="submit" class="btn btn-warning float-right">
                Save <span wire:loading wire:target="update" class="fas fa-spinner fa-spin"></span>
            </button> 
        </div>    
    </form>
</div>
