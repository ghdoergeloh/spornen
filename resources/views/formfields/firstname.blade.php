<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
	{{ Form::label('firstname', 'Vorname'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		@if(isset($required) && $required)
		{{ Form::text('firstname', null, [ 'class' => "form-control", 'required' => "required" ]) }}
		@else
		{{ Form::text('firstname', null, [ 'class' => "form-control"]) }}
		@endif

		@if ($errors->has('firstname'))
		<span class="help-block">
			<strong>{{ $errors->first('firstname') }}</strong>
		</span>
		@endif
	</div>
</div>