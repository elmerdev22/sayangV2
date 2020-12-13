
<!-- menu -->
<div class="d-md-none d-lg-none d-xl-none">
    <button data-toggle="modal" data-target="#modal_aside_right" class="btn btn-warning w-100" type="button"> <span class="fas fa-list"></span>  My Account </button>
</div>
<div id="MainMenu">
    <div class="hidden-xs d-none d-md-block d-lg-block ">
        @include('front-end.includes.user.sidebar')
    </div>
</div>

<div id="modal_aside_right" class="modal fixed-right fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-aside" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">My Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 m-0">
                @include('front-end.includes.user.sidebar')
            </div>
        </div>
    </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->