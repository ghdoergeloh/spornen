@extends('layouts.app')
@section('title')
- Passwort zurücksetzen
@endsection
@section('content')
<div class="card card-login mx-auto mt-5">
    <div class="card-header">Passwort zurücksetzen</div>
    <div class="card-body">
        <div class="text-center mt-4 mb-5">
          <h4>Passwort vergessen?</h4>
          <p>Gib Deine E-Mail-Adresse ein und wir senden Dir einen Link, über den Du dein Passwort zurücksetzen kannst.</p>
        </div>
		{{ Form::open([
		'method' => 'POST',
		'url' => 'password/email']) }}
		{{ csrf_field() }}
		@include('formfields.email')
		{{ Form::button('<i class="fa fa-envelope"></i> Link zum Zurücksetzen senden', ['type' => 'submit', 'class' => "btn btn-primary btn-block"]) }}
		{{ Form::close() }}
    </div>
</div>
@endsection
