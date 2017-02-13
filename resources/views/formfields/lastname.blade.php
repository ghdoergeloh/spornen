<div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
	{{ Form::label('lastname', 'Nachname'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		@if(isset($required) && $required)
		{{ Form::text('lastname', null, [ 'class' => "form-control", 'required' => "required" ]) }}
		@else
		{{ Form::text('lastname', null, [ 'class' => "form-control"]) }}
		@endif

		@if ($errors->has('lastname'))
		<span class="help-block">
			<strong>{{ $errors->first('lastname') }}</strong>
		</span>
		@endif
	</div>
</div>