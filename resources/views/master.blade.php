<!DOCTYPE html>
<html lang="en">
<head>
    @include('pages.blocks.head')
</head><!--/head-->

<body>
    <!--header-->
    @include('pages.blocks.header')
    <!--/header-->
	
	<section>
		<div class="container">
			<div class="row">
                @yield('content')
			</div>
		</div>
	</section>
	
	
	<!--footer*-->
    @include('pages.blocks.footer')
    <!--end footer-->
    @include('pages.blocks.foot')

</body>
</html>