<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
	<div class="col-md-10 col-md-offset-4">
		<div class="radio-inline">
			<label>
				{{ Form::radio('gender', 'm') }}
				Mann
			</label>
		</div>
		<div class="radio-inline">
			<label>
				{{ Form::radio('gender', 'f') }}
				Frau
			</label>
		</div>

		@if ($errors->has('gender'))
		<span class="help-block">
			<strong>{{ $errors->first('gender') }}</strong>
		</span>
		@endif
	</div>
</div>