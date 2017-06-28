<div class="panel panel-default">
	<div class="panel-heading">Anmelden</div>
	<div class="panel-body">
		{{ Form::open([
		'method' => 'POST',
		'url' => 'login',
		'class' => "form-horizontal"]) }}
		@include('formfields.email', ['required' => true])
		@include('formfields.password', ['required' => true])
		@include('formfields.remember')
		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-btn fa-sign-in"></i> Anmelden
				</button>

				<a class="btn btn-link" href="{{ url('/password/reset') }}">Passwort vergessen?</a>
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>