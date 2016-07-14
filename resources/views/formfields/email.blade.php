<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	{{ Form::label('email', 'E-Mail Addresse', [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		{{ Form::text('email', null, [ 'class' => "form-control"]) }}

		@if ($errors->has('email'))
		<span class="help-block">
			<strong>{{ $errors->first('email') }}</strong>
		</span>
		@endif
	</div>
</div>