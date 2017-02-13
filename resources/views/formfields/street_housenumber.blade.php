<div class="form-group{{ $errors->has('street') || $errors->has('housenumber') ? ' has-error' : '' }}">
	{{ Form::label('street', 'Straße, Nr.'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		@if(isset($required) && $required)
		{{ Form::text('street', null, [ 'class' => "form-control", 'style' => "width: calc( 70% - 2px ); display: inline-block;", 'required' => "required" ]) }}
		{{ Form::text('housenumber', null, [ 'class' => "form-control", 'style' => "width: calc( 30% - 2px ); display: inline-block;", 'required' => "required" ]) }}
		@else
		{{ Form::text('street', null, [ 'class' => "form-control", 'style' => "width: calc( 70% - 2px ); display: inline-block;"]) }}
		{{ Form::text('housenumber', null, [ 'class' => "form-control", 'style' => "width: calc( 30% - 2px ); display: inline-block;"]) }}
		@endif

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