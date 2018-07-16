@extends('layouts.app')
@section('title')
- Passwort zurücksetzen
@endsection
@section('content')
<div class="card card-login mx-auto mt-5">
    <div class="card-header">Passwort zurücksetzen</div>
    <div class="card-body">
		{{ Form::open([
		'method' => 'POST',
		'url' => 'password/reset']) }}
		
		{{ Form::hidden('token', $token) }}

		@include('formfields.email')
		@include('formfields.password')
		@include('formfields.password_confirmation')

		{{ Form::button('<i class="fa fa-refresh"></i> Passwort zurücksetzen', ['type' => 'submit', 'class' => "btn btn-primary btn-block"]) }}
		{{ Form::close() }}
    </div>
</div>
@endsection
