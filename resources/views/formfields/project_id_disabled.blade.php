<div class="form-group">
	{{ Form::label('id', 'Projekt-Nr.'.(isset($required) && $required ?' *':'')) }}

	<div class="col-md-6 " >
		{{ Form::output('id', null, [ 'class' => "form-control".($errors->has('id') ? ' is-invalid' : '')]) }}
	</div>
</div>