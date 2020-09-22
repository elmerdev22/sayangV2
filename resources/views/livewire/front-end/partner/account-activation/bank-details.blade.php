<div>
    <div class="row">
        <div class="col-sm-6"><h4>Bank Details</h4></div>
        <div class="col-sm-6"><p class="text-right">Please complete all fields <span class="fas fa-info-circle"></span></p></div>
    </div>
    <div class="row">
        <div class="col-12">
        <div class="form-group">
            <div class="row">
            <div class="col-lg-6">
                <label for="">Bank*</label>
                <select class="form-control">
                <option>Select</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label for="">Account Name*</label>
                <input type="text" class="form-control" id="" placeholder="Enter Account Name">
            </div>
            </div>
        </div>

        <div class="form-group">
            <label for="">Account Number*</label>
            <input type="text" class="form-control" id="" placeholder="Enter Account Number">
        </div>

        <button class="btn btn-warning" onclick="stepper1.previous()"><span class="fas fa-chevron-left"></span> Previous</button>
        <button type="submit" class="btn btn-warning text-white float-right" onclick="stepper1.next()">Next <span class="fas fa-chevron-right"></span></button>
        </div>
    </div>
</div>
