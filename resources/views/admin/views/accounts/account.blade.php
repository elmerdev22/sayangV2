@extends('admin.layouts.admin')
@section('header')
    <h1 class="m-0 text-dark">{{__(ucwords(Request::route()->action['name'].' / '.Request::route()->action['alter']))}}</h1>
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item">Accounts</li>
    <li class="breadcrumb-item active">{{__(ucwords(Request::route()->action['name']))}}</li>
@endsection
@section('view')
  <div class="container app-container">
    @livewire('admin.views.accounts.accounts')
  </div>
@endsection