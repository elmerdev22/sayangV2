<div>
    <div class="tracking-wrap">
        <div class="step step @if($status_level > 0) active @endif">
            <span class="icon"> <i class="fa fa-check"></i> </span>
            <span class="text">Order Placed</span>
        </div> <!-- step.// -->
        <div class="step step @if($status_level > 1) active @endif">
            <span class="icon"> <i class="fa fa-credit-card"></i> </span>
            <span class="text">Payment Confirmed</span>
        </div> <!-- step.// -->
        <div class="step @if($status_level > 2) active @endif">
            <span class="icon"> <i class="fa fa-truck"></i> </span>
            <span class="text">To Receive</span>
        </div> <!-- step.// -->
        <div class="step @if($status_level > 3) active @endif">
            <span class="icon"> <i class="fa fa-tasks"></i> </span>
            <span class="text">Completed</span>
        </div> <!-- step.// -->
    </div>
</div>