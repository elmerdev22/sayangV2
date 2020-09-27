<!-- To the right -->
<div class="float-right d-none d-sm-inline">
    {{env('APP_NAME')}} {{date('Y')}} | Version {{env('APP_VERSION', 'not_set_in_ENV')}}
</div>

<!-- Default to the left -->
<strong>Copyright &copy; {{date('Y')}} {{env('APP_NAME')}}.</strong> All rights reserved.
