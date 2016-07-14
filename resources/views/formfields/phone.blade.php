<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	{{ Form::label('phone', 'Telefon', [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		{{ Form::text('phone', null, [ 'class' => "form-control"]) }}

		@if ($errors->has('phone'))
		<span class="help-block">
			<strong>{{ $errors->first('phone') }}</strong>
		</span>
		@endif
	</div>
</div>