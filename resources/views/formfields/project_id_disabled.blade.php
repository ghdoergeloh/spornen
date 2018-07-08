<div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
	{{ Form::label('id', 'Projekt-Nr.'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6 " >
		{{ Form::text('id', null, [ 'class' => "form-control", 'readonly']) }}
	</div>
</div>