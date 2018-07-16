<div class="form-group">
	{{ Form::label('password', 'Passwort'.(isset($required) && $required ?' *':''), [ 'class' => ""]) }}

	<div class="">
		@if(isset($required) && $required)
		{{ Form::password('password', [ 'class' => "form-control".($errors->has('password') ? ' is-invalid' : ''), 'required' => "required" ]) }}
		@else
		{{ Form::password('password', [ 'class' => "form-control".($errors->has('password') ? ' is-invalid' : '')]) }}
		@endif

		@if ($errors->has('password'))
		<div class="invalid-feedback">
			{{ $errors->first('password') }}
		</div>
		@endif
	</div>
</div>