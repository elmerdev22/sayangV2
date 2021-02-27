@extends('front-end.layout')
@section('title','Completed Purchase')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Completed',
            'breadcrumbs' => [
                ['url' => '', 'label' => 'Completed List'],
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
                @livewire('front-end.user.my-purchase.completed.listing')
            </main>
        </div> <!-- row.// -->
        <!-- =========================  COMPONENT MY PROFILE.// ========================= --> 
    </div> <!-- container .//  -->
</section>         

@livewire('front-end.user.ratings.index')
@endsection
