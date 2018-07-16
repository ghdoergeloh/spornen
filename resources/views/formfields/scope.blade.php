<div class="form-group">
	{{ Form::label('scope', 'Bereich'.(isset($required) && $required ?' *':'')) }}

	<div>
		<div class="form-check form-check-inline">
			<label>
				@if(isset($required) && $required)
				{{ Form::radio('scope', 'person', null, [ 'class' => "form-check-input".($errors->has('scope') ? ' is-invalid' : ''), 'required' => "required" ]) }}
				@else
				{{ Form::radio('scope', 'person', null, [ 'class' => "form-check-input".($errors->has('scope') ? ' is-invalid' : '')]) }}
				@endif
				Person
			</label>
		</div>
		<div class="form-check form-check-inline">
			<label>
				{{ Form::radio('scope', 'project', [ 'class' => "form-check-input".($errors->has('scope') ? ' is-invalid' : '')]) }}
				Projekt
			</label>
		</div>

		@if ($errors->has('scope'))
		<div class="invalid-feedback">
			{{ $errors->first('scope') }}
		</div>
		@endif
	</div>
</div>