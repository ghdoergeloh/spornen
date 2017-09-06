{{ Form::open([
		'method' => 'POST',
		'url' => 'login',
		'class' => "form-horizontal"]) }}
<h2>Anmelden</h2>
@include('formfields.email', ['required' => true])
@include('formfields.password', ['required' => true])
@include('formfields.remember')
<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<button type="submit" class="btn btn-primary">
			<i class="fa fa-btn fa-sign-in"></i> Anmelden
		</button>

		<a class="btn btn-link" href="{{ url('/password/reset') }}">Passwort vergessen?</a>
		<hr>
		<a class="btn btn-link" href="{{ url('/register') }}">Registrieren</a>
	</div>
</div>
{{ Form::close() }}