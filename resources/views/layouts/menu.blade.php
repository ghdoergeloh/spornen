<nav class="navbar navbar-default navbar-static-top" id="top"
	 role="banner">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle collapsed" type="button"
					data-toggle="collapse" data-target="#bs-navbar"
					aria-controls="bs-navbar" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}">SponRun</a>
		</div>

		<div id="bs-navbar" class="navbar-collapse collapse"
			 aria-expanded="false">
			<ul class="nav navbar-nav">
				@if (Auth::check())
				<li><a href="{{ url('/home') }}">Home</a></li>
				<li><a href="{{ url('/sponsors/list') }}">Sponsoren</a></li>
				@endif
			</ul>
			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Authentication Links -->
				@if (Auth::guest())
				<li><a href="{{ url('/login') }}">Anmelden</a></li>
				<li><a href="{{ url('/register') }}">Registrieren</a></li>
				@else
				<li class="dropdown">
					<a href="#" class="dropdown-toggle"
					   data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->lastname}}, {{Auth::user()->firstname}}
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
						</li>
					</ul>
				</li>
				@endif
			</ul>
		</div>
	</div>
</nav>