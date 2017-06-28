<div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
	{{ Form::label('id', 'Projekt-Nr.'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6 " >
		@if(isset($required) && $required)
		{{ Form::number('id', null, [ 'class' => "form-control", 'required' => "required" ]) }}
		@else
		{{ Form::number('id', null, [ 'class' => "form-control"]) }}
		@endif

		@if ($errors->has('id'))
		<span class="help-block">
			<strong>{{ $errors->first('id') }}</strong>
		</span>
		@endif
	</div>
</div>