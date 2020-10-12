<div>

    <div class="row">
        <div class="col-lg-12">
            @for($x=1; $x <= 4;$x++)
                <blockquote class="@if($x == 1) quote-primary @else quote-secondary @endif">
                    <div class="row">
                        <div class="col-12">
                            <div class="float-xs-none float-sm-none float-md-right">
                                <button type="button" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-pen"></i></button>
                                <button type="button" class="btn btn-sm btn-danger ml-1" title="Delete"><i class="fas fa-trash"></i></button>
                            </div>
                            <span class="fas fa-user"></span> <strong>Christian De Leon @if($x == 1)<span class="badge badge-info">Default</span>@endif</strong>
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
                            <div class="text-right mt-2">
                                <button type="button" class="btn btn-sm btn-default" @if($x == 1) disabled @endif>Set as Default</button>
                            </div>
                        </div>
                    </div>
                </blockquote>
            @endfor
        </div>
    </div>

    
    <!-- <h4 class='text-muted'>No Address Found</h4> -->
</div>
