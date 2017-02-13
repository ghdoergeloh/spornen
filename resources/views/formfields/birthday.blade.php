<div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
	{{ Form::label('birthday', 'Geburtstag'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		@if(isset($required) && $required)
		{{ Form::date('birthday', null, [ 'class' => "form-control", 'required' => "required"]) }}
		@else
		{{ Form::date('birthday', null, [ 'class' => "form-control"]) }}
		@endif

		@if ($errors->has('birthday'))
		<span class="help-block">
			<strong>{{ $errors->first('birthday') }}</strong>
		</span>
		@endif
	</div>
</div>