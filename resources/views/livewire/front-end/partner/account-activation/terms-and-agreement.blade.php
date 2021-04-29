<div>
    <div class="row">
        <div class="col-12"><h4>Terms and Conditions</h4></div>
    </div>
    <div class="row pt-4">
        <div class="col-12">
            <form wire:submit.prevent="update">
                <h4 class="title text-center step-4-text font-weight-normal">By clicking on the button below, I agree with the Terms and Conditions of the platform.</h4>
                <div class="form-group py-4">
                <label class="custom-control custom-checkbox float-right">
                    <input type="checkbox" class="custom-control-input " id="agree" wire:model="agree"> 
                    <div class="custom-control-label"> I agree with the 
                        <a target="_blank" href="{{route('front-end.terms-and-conditions.partners')}}">Terms and Conditions</a>  
                    </div> 
                </label>
                </div>
                <button class="btn btn-primary" onclick="stepper1.previous()"><span class="fas fa-chevron-left"></span> Previous</button>
                <button type="submit" class="btn btn-primary text-white float-right" {{$agree ? '':'disabled="true"'}}>Proceed <span class="fas fa-chevron-right"></span></button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('terms_and_agreement_success', param => {
        stepper1.next();
    });
</script>
@endpush