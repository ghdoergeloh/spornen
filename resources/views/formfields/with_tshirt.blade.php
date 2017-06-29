<div class="form-group{{ $errors->has('with_tshirt') ? ' has-error' : '' }}">
	{{ Form::label('with_tshirt', 'Mit T-Shirt'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		<div class="radio-inline">
			<label>
				@if(isset($required) && $required)
				{{ Form::radio('with_tshirt', 1, [ 'required' => "required" ]) }}
				@else
				{{ Form::radio('with_tshirt', 1) }}
				@endif
				Ja
			</label>
		</div>
		<div class="radio-inline">
			<label>
				{{ Form::radio('with_tshirt', 0) }}
				Nein
			</label>
		</div>

		@if ($errors->has('with_tshirt'))
		<span class="help-block">
			<strong>{{ $errors->first('with_tshirt') }}</strong>
		</span>
		@endif
	</div>
</div>