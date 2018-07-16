<!DOCTYPE html>
<html lang="de">
@include('layouts.head')
@if (Auth::guest() && isset($bgWhite) && $bgWhite)
<body class="fixed-nav sticky-footer bg-white" id="page-top">
@else
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
@endif
	@if (Auth::guest())
	@include('layouts.menu', [ 'withoutLeftBar' => 'true'])
	<div class="container">
	@else
	@include('layouts.menu')
	<div class="content-wrapper">
	@endif
		<div class="container-fluid">
		 	@include('layouts.breadcrumbs')
			<div class="row">
				<div class="col-md-12">@include('layouts.messages')</div>
			</div>
			<div class="content">@yield('content')</div>
		</div>
	</div>
@include('layouts.footer_scripts')
</body>
</html>
