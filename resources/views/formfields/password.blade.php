<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	{{ Form::label('password', 'Passwort'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		@if(isset($required) && $required)
		{{ Form::password('password', [ 'class' => "form-control", 'required' => "required" ]) }}
		@else
		{{ Form::password('password', [ 'class' => "form-control"]) }}
		@endif

		@if ($errors->has('password'))
		<span class="help-block">
			<strong>{{ $errors->first('password') }}</strong>
		</span>
		@endif
	</div>
</div>