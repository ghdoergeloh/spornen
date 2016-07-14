<div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
	{{ Form::label('birthday', 'Geburtstag', [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		{{ Form::date('birthday', null, [ 'class' => "form-control"]) }}

		@if ($errors->has('birthday'))
		<span class="help-block">
			<strong>{{ $errors->first('birthday') }}</strong>
		</span>
		@endif
	</div>
</div>