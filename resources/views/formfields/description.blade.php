<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
	{{ Form::label('description', 'Beschreibung', [ 'class' => "col-md-4 control-label"]) }}
	<div class="col-md-6">
		{{ Form::textarea('description', null, [ 'class' => "form-control"]) }}
		@if ($errors->has('description'))
		<span class="help-block">
			<strong>{{ $errors->first('description') }}</strong>
		</span>
		@endif
	</div>
</div>