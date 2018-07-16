@extends('layouts.app')
@section('title')
- Login
@endsection
@section('content')
<div class="card card-login mx-auto mt-5">
	<div class="card-header">Login</div>
	<div class="card-body">
        {{ Form::open([
        		'method' => 'POST',
        		'url' => 'login']) }}
        @include('formfields.email', ['required' => true])
        @include('formfields.password', ['required' => true])
        @include('formfields.remember')
        {{ Form::button('<i class="fa fa-sign-in"></i> Anmelden', ['type' => 'submit', 'class' => "btn btn-primary btn-block"]) }}
		{{ Form::close() }}
		<div class="text-center">
            <a class="d-block small mt-3" href="{{ url('/register') }}">Registrieren</a>
            <a class="d-block small" href="{{ url('/password/reset') }}">Passwort vergessen?</a>
        </div>
	</div>
</div>
@endsection