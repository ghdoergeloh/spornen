<div class="form-group">
	<div class="form-check">
		<label class="form-check-label">
			{{ Form::checkbox('remember',null,null, [ 'class' => "form-check-input".($errors->has('remember') ? ' is-invalid' : '') ]) }} Angemeldet bleiben
		</label>
	</div>

	@if ($errors->has('remember'))
	<div class="invalid-feedback">
		{{ $errors->first('remember') }}
	</div>
	@endif
</div>
