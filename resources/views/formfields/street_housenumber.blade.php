<div class="form-group">
	{{ Form::label('street', 'Straße, Nr.'.(isset($required) && $required ?' *':'')) }}

	<div>
		@if(isset($required) && $required)
		{{ Form::text('street', null, [ 'class' => "form-control".($errors->has('street') ? ' is-invalid' : ''), 'style' => "width: calc( 70% - 3px ); display: inline-block;", 'required' => "required" ]) }}
		{{ Form::text('housenumber', null, [ 'class' => "form-control".($errors->has('housenumber') ? ' is-invalid' : ''), 'style' => "width: calc( 30% - 2px ); display: inline-block;", 'required' => "required" ]) }}
		@else
		{{ Form::text('street', null, [ 'class' => "form-control".($errors->has('street') ? ' is-invalid' : ''), 'style' => "width: calc( 70% - 3px ); display: inline-block;"]) }}
		{{ Form::text('housenumber', null, [ 'class' => "form-control".($errors->has('housenumber') ? ' is-invalid' : ''), 'style' => "width: calc( 30% - 2px ); display: inline-block;"]) }}
		@endif

		@if ($errors->has('street'))
		<div class="invalid-feedback">
			{{ $errors->first('street') }}
		</div>
		@endif

		@if ($errors->has('housenumber'))
		<div class="invalid-feedback">
			{{ $errors->first('housenumber') }}
		</div>
		@endif
	</div>
</div>