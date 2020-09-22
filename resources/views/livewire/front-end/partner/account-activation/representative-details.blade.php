<div>
    <div class="row">
        <div class="col-sm-6"><h4>Representative Details</h4></div>
        <div class="col-sm-6"><p class="text-right">Please complete all fields <span class="fas fa-info-circle"></span></p></div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <div class="row">
                <div class="col-lg-6">
                    <label for="firstname">First Name*</label>
                    <input type="text" class="form-control" id="business-name" placeholder="Enter Firstname">
                </div>
                <div class="col-lg-6">
                    <label for="lastname">Last Name*</label>
                    <input type="text" class="form-control" id="business-name" placeholder="Enter Lastname">
                </div>
                </div>
            </div>

            <div class="form-group">
                <label for="designation">Designation*</label>
                <input type="text" class="form-control" id="" placeholder="Enter Designation">
            </div>

            <div class="form-group">
                <label for="email">Email Address*</label>
                <input type="email" class="form-control" id="" placeholder="Enter Email Address">
            </div>

            <div class="form-group">
                <label for="">Contact*</label>
                <input type="text" class="form-control" id="" placeholder="Enter Contact">
            </div>

            <div class="form-group">
                <label for="">Upload ID Here*</label>
                <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="">
                    <label class="custom-file-label" for="">Choose file</label>
                </div>
                </div>
            </div>
            <button class="btn btn-warning" onclick="stepper1.previous()"><span class="fas fa-chevron-left"></span> Previous</button>
            <button type="submit" class="btn btn-warning text-white float-right" onclick="stepper1.next()">Next <span class="fas fa-chevron-right"></span></button>
        </div>
    </div>
</div>
