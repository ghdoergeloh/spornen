<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	{{ Form::label('email', 'E-Mail Addresse'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		@if(isset($required) && $required)
		{{ Form::text('email', null, [ 'class' => "form-control", 'required' => "required"]) }}
		@else
		{{ Form::text('email', null, [ 'class' => "form-control"]) }}
		@endif

		@if ($errors->has('email'))
		<span class="help-block">
			<strong>{{ $errors->first('email') }}</strong>
		</span>
		@endif
	</div>
</div>