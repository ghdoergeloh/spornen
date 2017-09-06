
<nav class="navbar navbar-expand-md navbar-light bg-faded fixed-top">
    <button class="navbar-toggler navbar-toggler-right" type="button"
            data-toggle="collapse" data-target="#bs-navbar"
            aria-controls="bs-navbar" aria-expanded="false" aria-label="Navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ url('/') }}">SponRun</a>

    <div class="collapse navbar-collapse" id="bs-navbar">
        <ul class="navbar-nav mr-auto">
            @if (Auth::check())
            <li class="nav-item"><a class="nav-link" href="{{ url('/home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('runpart.index') }}">Meine Sponsorenläufe</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('account.edit') }}">Mein Account</a></li>
            @if ( Entrust::hasRole('admin') )
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle"
                   data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Verwaltung
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a class="nav-link" href="{{ route('project.index') }}">Projekte</a>
                        <a class="nav-link" href="{{ route('projectlist.index') }}">Projektlisten</a>
                        <a class="nav-link" href="{{ route('sponrun.index') }}">Sponsorenläufe</a>
                    </li>
                </ul>
            </li>
            @endif
            @endif
		</ul>
        <ul class="navbar-nav">
            <!-- Authentication Links -->
            @if (Auth::guest())
            <li class="nav-item pull-right"><a class="nav-link" href="{{ url('/login') }}">Anmelden</a></li>
            <li class="nav-item pull-right"><a class="nav-link" href="{{ url('/register') }}">Registrieren</a></li>
            @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle"
                   data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    {{Auth::user()->lastname}}, {{Auth::user()->firstname}}
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href=""
                           onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                            <i class="fa fa-btn fa-sign-out"></i>Logout</a>
                        {{ Form::open([
								'method' => 'POST',
								'route' => 'logout',
								'class' => "hidden",
								'id' => 'logout-form']) }}
                        {{ Form::close() }}
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</nav>