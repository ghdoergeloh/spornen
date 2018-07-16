<div class="form-group">
	{{ Form::label('id', 'Projekt-Nr.'.(isset($required) && $required ?' *':'')) }}

	<div class="col-md-6 " >
		@if(isset($required) && $required)
		{{ Form::number('id', null, [ 'class' => "form-control".($errors->has('id') ? ' is-invalid' : ''), 'required' => "required" ]) }}
		@else
		{{ Form::number('id', null, [ 'class' => "form-control".($errors->has('id') ? ' is-invalid' : '')]) }}
		@endif

		@if ($errors->has('id'))
		<div class="invalid-feedback">
			{{ $errors->first('id') }}
		</div>
		@endif
	</div>
</div>