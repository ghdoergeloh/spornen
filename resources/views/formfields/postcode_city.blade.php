<div class="form-group{{ $errors->has('postcode') || $errors->has('city') ? ' has-error' : '' }}">
	{{ Form::label('postcode', 'PLZ, Ort', [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6 " >
		{{ Form::text('postcode', null, [ 'class' => "form-control", 'style' => "width: calc( 30% - 2px ); display: inline-block;"]) }}
		{{ Form::text('city', null, [ 'class' => "form-control", 'style' => "width: calc( 70% - 1px ); display: inline-block;"]) }}

		@if ($errors->has('postcode'))
		<span class="help-block">
			<strong>{{ $errors->first('postcode') }}</strong>
		</span>
		@endif
		@if ($errors->has('city'))
		<span class="help-block">
			<strong>{{ $errors->first('city') }}</strong>
		</span>
		@endif
	</div>
</div>