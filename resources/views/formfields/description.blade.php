<div class="form-group">
	{{ Form::label('description', 'Beschreibung'.(isset($required) && $required ?' *':'')) }}

	<div>
		@if(isset($required) && $required)
		{{ Form::textarea('description', null, [ 'class' => "form-control".($errors->has('description') ? ' is-invalid' : ''), 'required' => "required"]) }}
		@else
		{{ Form::textarea('description', null, [ 'class' => "form-control".($errors->has('description') ? ' is-invalid' : '')]) }}
		@endif

		@if ($errors->has('description'))
		<div class="invalid-feedback">
			{{ $errors->first('description') }}
		</div>
		@endif
	</div>
</div>