@extends('front-end.layout')
@section('title','Notifications - Order Updates')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Order Updates',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Order Updates'],
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
                @livewire('front-end.user.notifications.order-updates')
            </main>
        </div> <!-- row.// -->
        <!-- =========================  COMPONENT MY PROFILE.// ========================= --> 
    </div> <!-- container .//  -->
</section>            
@endsection