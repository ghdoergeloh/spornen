<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
	{{ Form::label('end', 'Ende', [ 'class' => "col-md-4 control-label"]) }}
	<div class="col-md-6">
		{{ Form::datetimelocal('end', null, [ 'class' => "form-control", 'placeholder' => Carbon\Carbon::now()]) }}
		@if ($errors->has('end'))
		<span class="help-block">
			<strong>{{ $errors->first('end') }}</strong>
		</span>
		@endif
	</div>
</div>