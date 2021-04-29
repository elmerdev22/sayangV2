@extends('front-end.layout')
@section('title','Change Password')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Change Password',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Change Password'],
            ],
        ];
    @endphp
    @include('front-end.includes.page-header', $page_header)
@endsection
@section('content')
          
<section class="section-content padding-y bg">
    <div class="container">
        <!-- =========================  COMPONENT MY PROFILE ========================= --> 
        <div class="row">
            <aside class="col-md-3">
                <!--   SIDEBAR   -->
                @include('front-end.includes.user.aside')
                <!--   SIDEBAR .//END   -->
            </aside>
            <main class="col-md-9">
                <div class="card">
                    <header class="card-header">
                        <strong class="d-inline-block mr-3">Change Password</strong>
                    </header>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-7">
                                @livewire('auth.change-password', ['redirect' => 'user_login'])
                            </div>
                        </div>
                    </div> <!-- card-body .// -->
                </div> <!-- card.// -->
            </main>
        </div> <!-- row.// -->
        <!-- =========================  COMPONENT MY PROFILE.// ========================= --> 
    </div> <!-- container .//  -->
</section>
@endsection