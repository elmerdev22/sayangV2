@extends('front-end.partner.layouts.layout')
@section('title','My Account')
@section('page_header')
    @php 
        $page_header = [
            'title'       => 'Bank & Cards',
            'breadcrumbs' => [
                ['url' => route('front-end.partner.my-account.index'), 'label' => 'Profile'],
                ['url' => '', 'label' => 'Bank & Cards'],
            ],
        ];
    @endphp
    @include('front-end.partner.layouts.includes.page-header', $page_header)
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card card-outline card-sayang mb-3">
            <div class="card-header">
                <h4 class="card-title">Banks & Cards</h4>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                @livewire('front-end.partner.my-account.banks-and-cards.listing')
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </div>
</div>

@endsection
@section('js')

@endsection