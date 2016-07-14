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