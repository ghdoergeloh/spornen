<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	{{ Form::label('password_confirmation', 'Passwort bestätigen'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		@if(isset($required) && $required)
		{{ Form::password('password_confirmation', [ 'class' => "form-control"]) }}
		@else
		{{ Form::password('password_confirmation', [ 'class' => "form-control"]) }}
		@endif

		@if ($errors->has('password_confirmation'))
		<span class="help-block">
			<strong>{{ $errors->first('password_confirmation') }}</strong>
		</span>
		@endif
	</div>
</div>