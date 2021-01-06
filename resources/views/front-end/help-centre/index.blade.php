@extends('front-end.layout')
@section('title','Help Centre')
@section('content')

<section class="content bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 my-5 text-center">
                <h1 class="display-5">We’re Here to Help!</h1>
                <div class="input-group input-group-lg">
                    <input class="form-control form-control-navbar border-0" type="search" placeholder="Ask away" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar bg-warning" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
<section class="content-header my-2">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Topics</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Help Centre</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container">
        @livewire('front-end.help-centre.topics')
    </div> 
</section>
@endsection
