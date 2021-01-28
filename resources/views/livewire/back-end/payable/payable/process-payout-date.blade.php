<div>
    <form method="POST" wire:submit.prevent="update">
        <div class="row">
            <div class="col-md-6">
                <label for="order_date_from">Orders Completed Date From</label>
                <input type="date" class="form-control @error('date_from') is-invalid @enderror" id="order_date_from" wire:model="date_from" max="{{date('Y-m-d')}}">
                @error('date_from')  
                    <span class="invalid-feedback">
                        <span>{{$message}}</span>
                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="order_date_to">Orders Completed Date To</label>
                <input type="date" class="form-control @error('date_to') is-invalid @enderror" id="order_date_to" wire:model="date_to" @if($date_from) min="{{$date_from}}" @endif max="{{date('Y-m-d')}}">
                @error('date_to')  
                    <span class="invalid-feedback">
                        <span>{{$message}}</span>
                    </span>
                @enderror
            </div>
        </div>
        <div class="text-right mt-3">
            <div class="form-group">
                <button type="submit" class="btn btn-warning btn-sm" wire:loading.attr="disabled" wire:target="update">
                    Continue <i class="fas fa-caret-right"></i> <i class="fas fa-spin fa-spinner" wire:loading wire:target="update"></i>
                </button>
            </div>
        </div>
    </form>
</div>
