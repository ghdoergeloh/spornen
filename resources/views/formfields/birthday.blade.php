<div class="form-group">
	{{ Form::label('birthday', 'Geburtstag'.(isset($required) && $required ?' *':'')) }}

	<div>
		@if(isset($required) && $required)
		{{ Form::date('birthday', null, [ 'class' => "form-control".($errors->has('birthday') ? ' is-invalid' : ''), 'required' => "required"]) }}
		@else
		{{ Form::date('birthday', null, [ 'class' => "form-control".($errors->has('birthday') ? ' is-invalid' : '')]) }}
		@endif

		@if ($errors->has('birthday'))
		<div class="invalid-feedback">
			{{ $errors->first('birthday') }}
		</div>
		@endif
	</div>
</div>