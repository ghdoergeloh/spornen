<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
	{{ Form::label('description', 'Beschreibung'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		@if(isset($required) && $required)
		{{ Form::textarea('description', null, [ 'class' => "form-control", 'required' => "required"]) }}
		@else
		{{ Form::textarea('description', null, [ 'class' => "form-control"]) }}
		@endif

		@if ($errors->has('description'))
		<span class="help-block">
			<strong>{{ $errors->first('description') }}</strong>
		</span>
		@endif
	</div>
</div>