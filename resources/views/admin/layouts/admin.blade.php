@extends('admin.layouts.app')
@section('css')
<style>
    .nav-link:(.active),{
        background-color: #FFDE59 !important;
    }
</style>
@endsection
@section('title')
    Admin CMS
@endsection
@section('content')
    <div class="wrapper">
        @include('admin.layouts.navbar')
        @include('admin.layouts.sidebar')
        <div class="content-wrapper px-4 py-2">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @yield('header')
                        </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumbs')
                        </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('view')
                </div>
            </section>
            <!--- End of Main content -->
        </div>
    </div>
@endsection
@section('js')
<script>
    window.livewire.on('alert', param => {
      var config = {
        position  : 'center',
      };

      if('title' in param)
        config['title'] = param['title'];
      if('type' in param)
        config['icon'] = param['type'];
      if('message' in param)
        config['html'] = param['message'];
      if('showConfirmButton' in param)
        config['showConfirmButton'] = param['showConfirmButton'];
      if('timer' in param)
        config['timer'] = param['timer'];

      Swal.fire(config);
    });

    window.livewire.on('alert_link', param => {
      Swal.fire({
          position         : 'center',
          icon             : param['type'],
          html             : param['message'],
          title            : param['title'],
          showConfirmButton: true,
          allowOutsideClick: false,
      }).then((result) => {
          if(result.value){
            if('redirect' in param){
              window.location = param['redirect'];                       
            }else{
              window.location.reload();                       
            }
          }
      });
    });
</script>
    yield('admin_js')
@endsection