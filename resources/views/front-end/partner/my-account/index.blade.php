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
    <aside class="col-md-3">
        <!-- menu -->
        <div id="MainMenu">
            @include('front-end.includes.partner.sidebar')
        </div>
    </aside> <!-- col.// -->
    <main class="col-md-9">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title"> My Account</h5> 
            </div>
            <div class="card-body">
                
            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </main> <!-- col.// -->
</div>

@endsection
@section('js')
<script type="text/javascript">
   
</script>
@endsection