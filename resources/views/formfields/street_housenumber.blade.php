<div class="form-group{{ $errors->has('street') || $errors->has('housenumber') ? ' has-error' : '' }}">
	{{ Form::label('street', 'Straße, Nr.', [ 'class' => "col-md-4 control-label"]) }}
	<div class="col-md-6">
		{{ Form::text('street', null, [ 'class' => "form-control", 'style' => "width: calc( 70% - 1px ); display: inline-block;"]) }}
		{{ Form::text('housenumber', null, [ 'class' => "form-control", 'style' => "width: calc( 30% - 2px ); display: inline-block;"]) }}

		@if ($errors->has('street'))
		<span class="help-block">
			<strong>{{ $errors->first('street') }}</strong>
		</span>
		@endif

		@if ($errors->has('housenumber'))
		<span class="help-block">
			<strong>{{ $errors->first('housenumber') }}</strong>
		</span>
		@endif
	</div>
</div>