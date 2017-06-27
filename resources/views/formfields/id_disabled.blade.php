<div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
	{{ Form::label('id', 'ID'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6 " >
		{{ Form::output('id', null, [ 'class' => "form-control"]) }}
	</div>
</div>