<div class="form-group">
	{{ Form::label('with_tshirt', 'Mit T-Shirt'.(isset($required) && $required ?' *':'')) }}

	<div>
		<div class="form-check {{ $errors->has('with_tshirt') ? ' is-invalid' : '' }}">
			<label class="form-check-label">
				@if(isset($required) && $required)
				{{ Form::radio('with_tshirt', 1, null, [ 'class' => "form-check-input".($errors->has('with_tshirt') ? ' is-invalid' : ''), 'required' => "required" ]) }}
				@else
				{{ Form::radio('with_tshirt', 1, null, [ 'class' => "form-check-input".($errors->has('with_tshirt') ? ' is-invalid' : '')]) }}
				@endif
				Ja
			</label>
		</div>
		<div class="form-check form-check-inline">
			<label class="form-check-label">
				{{ Form::radio('with_tshirt', 0, null, [ 'class' => "form-check-input".($errors->has('with_tshirt') ? ' is-invalid' : '')]) }}
				Nein
			</label>
		</div>

		@if ($errors->has('with_tshirt'))
		<div class="invalid-feedback" style="display: block;">
			{{ $errors->first('with_tshirt') }}
		</div>
		@endif
	</div>
</div>