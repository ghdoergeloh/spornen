<div class="form-group">
	{{ Form::label('gender', 'Geschlecht'.(isset($required) && $required ?' *':'')) }}

	<div>
		<div class="form-check form-check-inline{{ $errors->has('gender') ? ' is-invalid' : '' }}">
			<label class="form-check-label">
				@if(isset($required) && $required)
				{{ Form::radio('gender', 'm', null, [ 'class' => "form-check-input".($errors->has('gender') ? ' is-invalid' : ''), 'required' => "required" ]) }}
				@else
				{{ Form::radio('gender', 'm', null, [ 'class' => "form-check-input".($errors->has('gender') ? ' is-invalid' : '')]) }}
				@endif
				Mann
			</label>
		</div>
		<div class="form-check form-check-inline">
			<label class="form-check-label">
			{{ Form::radio('gender', 'f', null, [ 'class' => "form-check-input".($errors->has('gender') ? ' is-invalid' : '')]) }}
			Frau
			</label>
		</div>

		@if ($errors->has('gender'))
		<div class="invalid-feedback">
			{{ $errors->first('gender') }}
		</div>
		@endif
	</div>
</div>