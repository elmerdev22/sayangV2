<div>

    <div class="row mt-2">
        <div class="col-lg-12 px-5">
            @for($x=1; $x <= 4;$x++)
                <div class="row">
                    <div class="col-12">
                        <span class="fas fa-user"></span> <strong>Christian De Leon @if($x == 1)<span class="badge badge-info">Default</span>@endif</strong>
                        <button type="button" class="btn btn-sm btn-danger float-right ml-1" title="Delete"><i class="fas fa-trash"></i></button>
                        <button type="button" class="btn btn-sm btn-primary float-right" title="Edit"><i class="fas fa-pen"></i></button>
                    </div>
                </div>
                <div>
                    <span class="fas fa-phone"></span> +63913478864
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <span class="fas fa-map-marker"></span>
                        Unit 301, WackWack Royal Mansion, 
                        WackWack Greenhil, Mandaluyong City, Metro Manila
                        Wack-Wack Greenhills, Mandaluyong City
                        Metro Manila, Metro Manila 1555
                    </div>
                    <div class="col-sm-4">
                        <div class="text-right">
                            <button type="button" class="btn btn-sm btn-default" @if($x == 1) disabled @endif>Set as Default</button>
                        </div>
                    </div>
                </div>
                <hr>
            @endfor
        </div>
    </div>

    
    <!-- <h4 class='text-muted'>No Address Found</h4> -->
</div>
