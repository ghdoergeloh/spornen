@extends('layouts.app')
@section('title')
- Registrieren
@endsection
@section('content')
<div class="card card-login mx-auto mt-5">
	<div class="card-header">Registrieren</div>
	<div class="card-body">
		{{ Form::open([
		'method' => 'POST',
		'url' => 'register']) }}
		@include('auth.userForm')
		@include('formfields.email', ['required' => true])
		@include('formfields.password', ['required' => true])
		@include('formfields.password_confirmation', ['required' => true])
		{{ Form::button('<i class="fa fa-sign-in"></i> Registrieren', ['type' => 'submit', 'class' => "btn btn-primary btn-block"]) }}
		{{ Form::close() }}
		<div class="text-center">
            <a class="d-block small mt-3" href="{{ url('/login') }}">Anmelden</a>
            <a class="d-block small" href="{{ url('/password/reset') }}">Passwort vergessen?</a>
        </div>
	</div>
</div>
@endsection
