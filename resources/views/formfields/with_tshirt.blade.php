<div class="form-group">
	{{ Form::label('with_tshirt', 'Mit T-Shirt'.(isset($required) && $required ?' *':'')) }}

	<div>
		<div class="form-check form-check-inline {{ $errors->has('with_tshirt') ? ' is-invalid' : '' }}">
			@if(isset($required) && $required)
			{{ Form::radio('with_tshirt', 1, null, [ 'class' => "form-check-input".($errors->has('with_tshirt') ? ' is-invalid' : ''), 'required' => "required" ]) }}
			@else
			{{ Form::radio('with_tshirt', 1, null, [ 'class' => "form-check-input".($errors->has('with_tshirt') ? ' is-invalid' : '')]) }}
			@endif
			{{ Form::label('1', 'Ja', [ 'class' => "form-check-label"]) }}
		</div>
		<div class="form-check form-check-inline">
			{{ Form::radio('with_tshirt', 0, null, [ 'class' => "form-check-input".($errors->has('with_tshirt') ? ' is-invalid' : '')]) }}
			{{ Form::label('0', 'Nein', [ 'class' => "form-check-label"]) }}
		</div>

		@if ($errors->has('with_tshirt'))
		<div class="invalid-feedback" style="display: block;">
			{{ $errors->first('with_tshirt') }}
		</div>
		@endif
	</div>
</div>