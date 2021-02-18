<div>
    <div class="icon">
        <i class="icon-sm rounded-circle border fa fa-bell"></i>
        @if ($data->count() > 0)
            <span class="notify">{{number_format($data->count(),0)}}</span>
        @endif
    </div>
</div>