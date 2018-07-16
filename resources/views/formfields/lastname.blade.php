<div class="form-group">
	{{ Form::label('lastname', 'Nachname'.(isset($required) && $required ?' *':'')) }}

	<div>
		@if(isset($required) && $required)
		{{ Form::text('lastname', null, [ 'class' => "form-control".($errors->has('lastname') ? ' is-invalid' : ''), 'required' => "required" ]) }}
		@else
		{{ Form::text('lastname', null, [ 'class' => "form-control".($errors->has('lastname') ? ' is-invalid' : '')]) }}
		@endif

		@if ($errors->has('lastname'))
		<div class="invalid-feedback">
			{{ $errors->first('lastname') }}
		</div>
		@endif
	</div>
</div>