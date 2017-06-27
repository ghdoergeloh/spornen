<div class="form-group{{ $errors->has('scope') ? ' has-error' : '' }}">
	{{ Form::label('scope', 'Bereich'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		<div class="radio-inline">
			<label>
				@if(isset($required) && $required)
				{{ Form::radio('scope', 'person', [ 'required' => "required" ]) }}
				@else
				{{ Form::radio('scope', 'person') }}
				@endif
				Person
			</label>
		</div>
		<div class="radio-inline">
			<label>
				{{ Form::radio('scope', 'project') }}
				Projekt
			</label>
		</div>

		@if ($errors->has('scope'))
		<span class="help-block">
			<strong>{{ $errors->first('scope') }}</strong>
		</span>
		@endif
	</div>
</div>