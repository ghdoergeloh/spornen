<div class="form-group">
	{{ Form::label('postcode', 'PLZ, Ort'.(isset($required) && $required ?' *':'')) }}

	<div>
		@if(isset($required) && $required)
		{{ Form::text('postcode', null, [ 'class' => "form-control".($errors->has('postcode') ? ' is-invalid' : ''), 'style' => "width: calc( 30% - 2px ); display: inline-block;", 'required' => "required" ]) }}
		{{ Form::text('city', null, [ 'class' => "form-control".($errors->has('city') ? ' is-invalid' : ''), 'style' => "width: calc( 70% - 3px ); display: inline-block;", 'required' => "required" ]) }}
		@else
		{{ Form::text('postcode', null, [ 'class' => "form-control".($errors->has('postcode') ? ' is-invalid' : ''), 'style' => "width: calc( 30% - 2px ); display: inline-block;"]) }}
		{{ Form::text('city', null, [ 'class' => "form-control".($errors->has('city') ? ' is-invalid' : ''), 'style' => "width: calc( 70% - 3px ); display: inline-block;"]) }}
		@endif

		@if ($errors->has('postcode'))
		<div class="invalid-feedback">
			{{ $errors->first('postcode') }}
		</div>
		@endif
		@if ($errors->has('city'))
		<div class="invalid-feedback">
			{{ $errors->first('city') }}
		</div>
		@endif
	</div>
</div>