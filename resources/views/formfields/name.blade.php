<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
	{{ Form::label('name', 'Name'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		@if(isset($required) && $required)
		{{ Form::text('name', null, [ 'class' => "form-control", 'required' => "required" ]) }}
		@else
		{{ Form::text('name', null, [ 'class' => "form-control"]) }}
		@endif

		@if ($errors->has('name'))
		<span class="help-block">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
		@endif
	</div>
</div>