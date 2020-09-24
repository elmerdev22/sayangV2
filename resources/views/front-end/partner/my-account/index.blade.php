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
        @include('front-end.includes.partner.sidebar')
    </aside> <!-- col.// -->
    <main class="col-md-9">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title"> My Account</h5> 
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Name</label>
                            <p>Christian de Leon</p>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <p>cmdl.deleon02@gmail.com</p>
                        </div>
                        <div class="form-group">
                            <label>Contact Number</label>
                            <p>09058054844</p>
                        </div>
                        <div class="form-group">
                            <label>Member Since</label>
                            <p>September 2020</p>
                        </div>
                    </div>
                </div>
                

            </div> <!-- card-body .// -->
        </div> <!-- card.// -->
    </main> <!-- col.// -->
</div>

@endsection
@section('js')
<script type="text/javascript">
   
</script>
@endsection