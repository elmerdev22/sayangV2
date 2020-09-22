<div>
    <div class="row">
        <div class="col-12"><h4>Terms and Conditions</h4></div>
    </div>
    <div class="row pt-4">
        <div class="col-12">
            <h4 class="title text-center">By clicking on the button below, I agree on the TERMS and AGREEMENT of the platform.</h4>
            <div class="form-group py-4 text-center">
                <input type="radio" id="agree" name="terms" value="agree">
                <label for="agree">I Agree to the Terms and Agreement</label><br>
                <input type="radio" id="disagree" name="terms" value="disagree">
                <label for="disagree">Disagree and cancel application</label><br>
            </div>
            <button class="btn btn-warning" onclick="stepper1.previous()"><span class="fas fa-chevron-left"></span> Previous</button>
            <button type="submit" class="btn btn-warning text-white float-right" onclick="stepper1.next()">Proceed <span class="fas fa-chevron-right"></span></button>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    
</script>
@endpush