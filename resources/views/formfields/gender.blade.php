<div class="form-group">
	{{ Form::label('gender', 'Geschlecht'.(isset($required) && $required ?' *':'')) }}

	<div>
		<div class="form-check form-check-inline{{ $errors->has('gender') ? ' is-invalid' : '' }}">
			@if(isset($required) && $required)
			{{ Form::radio('gender', 'm', null, [ 'class' => "form-check-input".($errors->has('gender') ? ' is-invalid' : ''), 'required' => "required" ]) }}
			@else
			{{ Form::radio('gender', 'm', null, [ 'class' => "form-check-input".($errors->has('gender') ? ' is-invalid' : '')]) }}
			@endif
			{{ Form::label('m', 'Mann', [ 'class' => "form-check-label"]) }}
		</div>
		<div class="form-check form-check-inline">
			{{ Form::radio('gender', 'f', null, [ 'class' => "form-check-input".($errors->has('gender') ? ' is-invalid' : '')]) }}
			{{ Form::label('f', 'Frau', [ 'class' => "form-check-label"]) }}
		</div>

		@if ($errors->has('gender'))
		<div class="invalid-feedback">
			{{ $errors->first('gender') }}
		</div>
		@endif
	</div>
</div>