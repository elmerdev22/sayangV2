@extends('admin.layouts.admin')
@section('header')
    <h1 class="m-0 text-dark">{{__(ucwords(Request::route()->action['name']))}}</h1>
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item">Accounts</li>
    <li class="breadcrumb-item active">{{__(ucwords(Request::route()->action['name']))}}</li>
@endsection
@section('view')
  <div class="container app-container">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-warning card-outline">
          <div class="card-header">
            <h4 class="text-center">Add Main Category</h4>
          </div>
          <div class="card-body">
              <div class="container">
                <form wire:submit.prevent='add_main_category'>
                  <div class="form-group">
                    <label for='category'>Category<i class='text-danger'>*</i></label>
                    <input id='category' type="text" class="form-control" wire:model='input_category' autofocus>
                  </div>
                  <div class="float-right">
                    <button class="btn btn-success rounded">
                      <i class="fas fa-check"></i> Save
                    </button>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        @livewire('admin.views.products.catalog')
      </div>

    </div>
  </div>
@endsection