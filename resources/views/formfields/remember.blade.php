<div class="form-group{{ $errors->has('remember') ? ' has-error' : '' }}">
	<div class="col-md-6 col-md-offset-4">
		<div class="checkbox">
			<label>
				{{ Form::checkbox('remember') }} Angemeldet bleiben
			</label>
		</div>

		@if ($errors->has('remember'))
		<span class="help-block">
			<strong>{{ $errors->first('remember') }}</strong>
		</span>
		@endif
	</div>
</div>
