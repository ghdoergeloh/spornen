<div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
	{{ Form::label('lastname', 'Nachname', [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		{{ Form::text('lastname', null, [ 'class' => "form-control"]) }}

		@if ($errors->has('lastname'))
		<span class="help-block">
			<strong>{{ $errors->first('lastname') }}</strong>
		</span>
		@endif
	</div>
</div>