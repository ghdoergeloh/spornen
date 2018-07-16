<div class="form-group">
	{{ Form::label('email', 'E-Mail-Adresse'.(isset($required) && $required ?' *':'')) }}

	<div>
		@if(isset($required) && $required)
		{{ Form::text('email', null, [ 'class' => "form-control".($errors->has('email') ? ' is-invalid' : ''),
			'required' => "required"]) }}
		@else
		{{ Form::text('email', null, [ 'class' => "form-control".($errors->has('email') ? ' is-invalid' : '')]) }}
		@endif

		@if ($errors->has('email'))
		<div class="invalid-feedback">
			{{ $errors->first('email') }}
		</div>
		@endif
	</div>
</div>