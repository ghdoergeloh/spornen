<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
	{{ Form::label('firstname', 'Vorname', [ 'class' => "col-md-4 control-label"]) }}
	<div class="col-md-6">
		{{ Form::text('firstname', null, [ 'class' => "form-control"]) }}
		@if ($errors->has('firstname'))
		<span class="help-block">
			<strong>{{ $errors->first('firstname') }}</strong>
		</span>
		@endif
	</div>
</div>