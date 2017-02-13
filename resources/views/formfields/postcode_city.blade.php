<div class="form-group{{ $errors->has('postcode') || $errors->has('city') ? ' has-error' : '' }}">
	{{ Form::label('postcode', 'PLZ, Ort'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6 " >
		@if(isset($required) && $required)
		{{ Form::text('postcode', null, [ 'class' => "form-control", 'style' => "width: calc( 30% - 2px ); display: inline-block;", 'required' => "required" ]) }}
		{{ Form::text('city', null, [ 'class' => "form-control", 'style' => "width: calc( 70% - 2px ); display: inline-block;", 'required' => "required" ]) }}
		@else
		{{ Form::text('postcode', null, [ 'class' => "form-control", 'style' => "width: calc( 30% - 2px ); display: inline-block;"]) }}
		{{ Form::text('city', null, [ 'class' => "form-control", 'style' => "width: calc( 70% - 2px ); display: inline-block;"]) }}
		@endif

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