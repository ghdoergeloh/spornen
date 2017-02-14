<div class="form-group{{ $errors->has('laps') ? ' has-error' : '' }}">
	{{ Form::label('laps', 'Gelaufene Runden'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6 " >
		@if(isset($required) && $required)
		{{ Form::number('laps', null, [ 'class' => "form-control", 'required' => "required" ]) }}
		@else
		{{ Form::number('laps', null, [ 'class' => "form-control"]) }}
		@endif

		@if ($errors->has('laps'))
		<span class="help-block">
			<strong>{{ $errors->first('laps') }}</strong>
		</span>
		@endif
	</div>
</div>