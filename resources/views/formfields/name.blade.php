<div class="form-group">
	{{ Form::label('name', 'Name'.(isset($required) && $required ?' *':'')) }}

	<div>
		@if(isset($required) && $required)
		{{ Form::text('name', null, [ 'class' => "form-control".($errors->has('name') ? ' is-invalid' : ''), 'required' => "required" ]) }}
		@else
		{{ Form::text('name', null, [ 'class' => "form-control".($errors->has('name') ? ' is-invalid' : '')]) }}
		@endif

		@if ($errors->has('name'))
		<div class="invalid-feedback">
			{{ $errors->first('name') }}
		</div>
		@endif
	</div>
</div>