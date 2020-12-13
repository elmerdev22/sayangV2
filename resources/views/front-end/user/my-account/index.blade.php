@extends('front-end.layout')
@section('title','My Account')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'My Account',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'My Account'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
          
<div class="row">
    <aside class="col-md-3 mb-3">
        @include('front-end.includes.user.aside')
    </aside> <!-- col.// -->
    <main class="col-md-9">
        <div class="card card-outline card-sayang mb-3">
            <div class="card-header">
                <h5 class="card-title"> My Account</h5> 
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @livewire('front-end.user.my-account.index.profile-picture')
                    </div>
                    <div class="col-md-8">
                        @livewire('front-end.user.my-account.index.account-information')
                    </div>
                </div>
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </main> <!-- col.// -->
</div>

<!-- Modal -->
<div id="modal-edit_profile_picture" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload New Photo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                @livewire('front-end.user.my-account.index.edit-profile-picture')
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection