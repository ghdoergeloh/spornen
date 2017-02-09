<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
	{{ Form::label('name', 'Name', [ 'class' => "col-md-4 control-label"]) }}
	<div class="col-md-6">
		{{ Form::text('name', null, [ 'class' => "form-control"]) }}
		@if ($errors->has('name'))
		<span class="help-block">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
		@endif
	</div>
</div>