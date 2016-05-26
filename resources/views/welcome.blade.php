@extends('layouts.app') @section('title') Willkommen @endsection
@section('content')
<div class="row">
	<div class="col-md-4">
		<img class="img-responsive" alt="To All Nations" src="../images/tan_900.jpg">
	</div>
	<div class="col-md-4">
		<form action="/login" method="POST">
			<div class="form-group">
				<h1>Anmelden</h1>
				<label for="email">E-Mail</label> <input type="email"
					class="form-control" id="email" placeholder="E-Mail">
			</div>
			<div class="form-group">
				<label for="password">Passwort</label> <input type="password"
					class="form-control" id="password" placeholder="Passwort">
			</div>
			<button type="submit" class="btn btn-default">Anmelden</button>
		</form>
		<form action="/register" method="POST">
			<h1>Registrieren</h1>
			<div class="form-group">
				<label for="new_email">Vorname</label> <input type="text"
					class="form-control" id="new_email" placeholder="Email">
			</div>
			<div class="form-group">
				<label for="new_email">Nachname</label> <input type="text"
					class="form-control" id="new_email" placeholder="Email">
			</div>
			<div class="form-group">
				<label for="new_email">E-Mail</label> <input type="email"
					class="form-control" id="new_email" placeholder="E-Mail">
			</div>
			<div class="form-group">
				<label for="new_password">Neues Passwort</label> <input type="password"
					class="form-control" id="new_password" placeholder="Neues Passwort">
			</div>
			<div class="form-group">
				<label for="new_password_again">Passwort wiederholen</label> <input type="password"
					class="form-control" id="new_password_again" placeholder="Passwort wiederholen">
			</div>
			<button type="submit" class="btn btn-default">Registrieren</button>
		</form>
	</div>
</div>
@endsection
