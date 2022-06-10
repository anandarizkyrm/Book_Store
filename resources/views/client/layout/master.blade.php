<!DOCTYPE html>
<html lang="zxx">
<head>
	@include('client.layout.head')	
</head>
<body class="js">
	
	<!-- Preloader -->
     {{-- <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
            </div>
        </div> --}}
	<!-- End Preloader -->

	@include('client.layout.notification')
	<!-- Header --> 
	@include('client.layout.header')
	<!--/ End Header -->
	 @yield('main-content')
	
	{{-- @include('client.layout.footer')  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>

@stack('js')