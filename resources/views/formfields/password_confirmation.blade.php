<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	<label for="password-confirm" class="col-md-4 control-label">Passwort bestätigen</label>

	<div class="col-md-6">
		{{ Form::password('password_confirmation', [ 'class' => "form-control"]) }}

		@if ($errors->has('password_confirmation'))
		<span class="help-block">
			<strong>{{ $errors->first('password_confirmation') }}</strong>
		</span>
		@endif
	</div>
</div>