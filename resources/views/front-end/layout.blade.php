<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		@if(Request::is('/'))
			<title>{{ env('APP_NAME') }} - @yield('title')</title>
		@else
			<title>@yield('title') | {{ env('APP_NAME') }}</title>
		@endif

		<link rel="icon" type="image/icon" href="{{UploadUtility::content_photo('icon')}}">
			<link href="{{ mix('css/app.css') }}" rel="stylesheet">
		@yield('css')

		@livewireStyles
	</head>

	<body>
		
        @if(!Route::is('admin.login'))
			<!-- ========================= HEADER ========================= -->
			@include('front-end.header.index')
			<!-- ========================= HEADER END// ========================= -->
        @endif
		
		<!-- ========================= CONTENT ========================= -->
			<div style="padding-top: 60px;">
				@yield('content')
			</div>
		<!-- ========================= CONTENT END// ========================= -->
		
        @if(!Route::is('admin.login'))
			<!-- ========================= FOOTER ========================= -->
			@include('front-end.footer.index')
			<!-- ========================= FOOTER END // ========================= -->
        @endif
		
		<script src="{{ mix('js/app.js') }}"></script>
	
        <script src="{{asset('template/assets/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('template/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- SweetAlert2 -->
		<script src="{{ asset('template/assets/dist/js/sweetalert2.min.js') }}"></script>
        <!-- Pusher JS -->
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <!-- Countdown JS -->
        <script src="{{asset('template/assets/dist/js/countdown.js')}}"></script>
        <!-- Custom JS -->
        @yield('js')
		
        <script src="{{asset('template/assets/dist/js/custom.js')}}"></script>

		@livewireScripts
		
		<script type="text/javascript">
			// Enable pusher logging - don't include this in production
			Pusher.logToConsole    = @if(env('APP_ENV') == 'local') true @else false @endif;
				var pusher_key_app_key = '{{env('PUSHER_APP_KEY')}}';
				var push_init          = new Pusher(pusher_key_app_key, {
					cluster: 'ap1'
			});
			
			// badge-total-item-in-cart
			window.livewire.on('initialize_cart_item_count', param => {
				var total_item_in_cart = parseInt(param['total']);
				$(document).find('.badge-total-item-in-cart').each(function () {
					if(total_item_in_cart > 0){
						$(this).html('<span class="badge badge-warning">'+total_item_in_cart+'</span>');
					}else{
						$(this).html('');
					}
				});
			});
	
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
		@stack('scripts')
	</body>
</html>

