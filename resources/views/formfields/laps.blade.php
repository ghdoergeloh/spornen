<div class="form-group">
	{{ Form::label('laps', 'Gelaufene Runden'.(isset($required) && $required ?' *':'')) }}

	<div>
		@if(isset($required) && $required)
		{{ Form::number('laps', null, [ 'class' => "form-control".($errors->has('laps') ? ' is-invalid' : ''), 'required' => "required" ]) }}
		@else
		{{ Form::number('laps', null, [ 'class' => "form-control".($errors->has('laps') ? ' is-invalid' : '')]) }}
		@endif

		@if ($errors->has('laps'))
		<div class="invalid-feedback">
			{{ $errors->first('laps') }}
		</div>
		@endif
	</div>
</div>