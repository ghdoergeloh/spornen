<div class="form-group">
	{{ Form::label('phone', 'Telefon'.(isset($required) && $required ?' *':'')) }}

	<div>
		@if(isset($required) && $required)
		{{ Form::text('phone', null, [ 'class' => "form-control".($errors->has('phone') ? ' is-invalid' : ''), 'required' => "required" ]) }}
		@else
		{{ Form::text('phone', null, [ 'class' => "form-control".($errors->has('phone') ? ' is-invalid' : '')]) }}
		@endif

		@if ($errors->has('phone'))
		<div class="invalid-feedback">
			{{ $errors->first('phone') }}
		</div>
		@endif
	</div>
</div>