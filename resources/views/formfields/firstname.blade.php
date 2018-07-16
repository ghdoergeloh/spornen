<div class="form-group">
	{{ Form::label('firstname', 'Vorname'.(isset($required) && $required ?' *':'')) }}

	<div>
		@if(isset($required) && $required)
		{{ Form::text('firstname', null, [ 'class' => "form-control".($errors->has('firstname') ? ' is-invalid' : ''), 'required' => "required" ]) }}
		@else
		{{ Form::text('firstname', null, [ 'class' => "form-control".($errors->has('firstname') ? ' is-invalid' : '')]) }}
		@endif

		@if ($errors->has('firstname'))
		<div class="invalid-feedback">
			{{ $errors->first('firstname') }}
		</div>
		@endif
	</div>
</div>