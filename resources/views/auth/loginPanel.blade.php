<div class="panel panel-default">
	<div class="panel-heading">Anmelden</div>
	<div class="panel-body">
		{{ Form::open([
		'method' => 'POST',
		'url' => 'login',
		'class' => "form-horizontal"]) }}

		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			{{ Form::label('email', 'E-Mail Addresse', [ 'class' => "col-md-4 control-label"]) }}

			<div class="col-md-6">
				{{ Form::text('email', null, [ 'class' => "form-control"]) }}

				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			{{ Form::label('password', 'Passwort', [ 'class' => "col-md-4 control-label"]) }}

			<div class="col-md-6">
				{{ Form::password('password', [ 'class' => "form-control"]) }}

				@if ($errors->has('password'))
				<span class="help-block">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="remember"> Angemeldet bleiben
					</label>
				</div>
			</div>
		</div>

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