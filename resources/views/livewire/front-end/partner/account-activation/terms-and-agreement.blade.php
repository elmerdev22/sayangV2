<div>
    <div class="row">
        <div class="col-12"><h4>Terms and Conditions</h4></div>
    </div>
    <div class="row pt-4">
        <div class="col-12">
            <form wire:submit.prevent="update">
                <h4 class="title text-center step-4-text">By clicking on the button below, I agree on the Terms and Conditions of the platform.</h4>
                <div class="form-group py-4 text-center">
                    <input type="checkbox" class="input-md" id="agree" wire:model="agree">
                    <label for="agree">I Agree to the <u><a target="_blank" href="{{route('front-end.terms-and-conditions.partners')}}">Terms and Conditions</a></u></label><br>
                </div>
                <button class="btn btn-warning" onclick="stepper1.previous()"><span class="fas fa-chevron-left"></span> Previous</button>
                <button type="submit" class="btn btn-warning text-white float-right" {{$agree ? '':'disabled="true"'}}>Proceed <span class="fas fa-chevron-right"></span></button>
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