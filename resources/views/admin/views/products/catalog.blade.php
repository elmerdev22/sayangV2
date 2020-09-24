@extends('admin.layouts.admin')
@section('header')
    <h1 class="m-0 text-dark">{{__(ucwords(Request::route()->action['name']))}}</h1>
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item">Products</li>
    <li class="breadcrumb-item active">{{__(ucwords(Request::route()->action['name']))}}</li>
@endsection
@section('view')
  <div class="container app-container">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-warning card-outline">
          <div class="card-header">
            <div class="text-center card-title">Add Main Category</div>
          </div>
          <div class="card-body">
              <div class="container">
                @livewire('admin.views.products.catalog.forms.main-category')
              </div>
          </div>
        </div>
      </div>
      <div class="col-md-9">
          @livewire('admin.views.products.catalog.components.main-category-cards')
      </div>
    </div>
  </div>
@endsection
@section('admin_js')

@endsection