<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
	{{ Form::label('gender', 'Geschlecht'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		<div class="radio-inline">
			<label>
				@if(isset($required) && $required)
				{{ Form::radio('gender', 'm', [ 'required' => "required" ]) }}
				@else
				{{ Form::radio('gender', 'm') }}
				@endif
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