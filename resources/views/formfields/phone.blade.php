<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	{{ Form::label('phone', 'Telefon'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		@if(isset($required) && $required)
		{{ Form::text('phone', null, [ 'class' => "form-control", 'required' => "required" ]) }}
		@else
		{{ Form::text('phone', null, [ 'class' => "form-control"]) }}
		@endif

		@if ($errors->has('phone'))
		<span class="help-block">
			<strong>{{ $errors->first('phone') }}</strong>
		</span>
		@endif
	</div>
</div>