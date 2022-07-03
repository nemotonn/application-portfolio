<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>掃除管理</title>
		<link href="{{ asset('css/mainstyle.css') }}" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

		<!-- @stack('css') -->
	</head>
	<body>

		<div class="wrapper">

				@auth
					<header>
						  @include('header')
					</header>

					<div class="content-wrapper">

						<nav class="pc-side-nav">
							@include('side-nav')
						</nav>

						<div class="main-container">
							@yield('content')
						</div>
					</div>
				@endauth


				@guest
					@yield('auth')
				@endguest

			</div>

			<script src="{{ asset('js/navtoggle.js') }}" defer></script>
			<script src="{{ asset('js/formtoggle.js') }}" defer></script>
			<script src="{{ asset('js/alert.js') }}" defer></script>
			<script src="{{ asset('js/activelink.js') }}" defer></script>

	</body>
</html>
