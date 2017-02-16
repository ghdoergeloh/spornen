<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
	{{ Form::label('firstname', 'Beginn'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		@if(isset($required) && $required)
		{{ Form::datetimelocal('begin', null , ['class' => "form-control", 'placeholder' => Carbon\Carbon::now()->format('Y-m-d\TH:i'), 'required' => "required"]) }}
		@else
		{{ Form::datetimelocal('begin', null , ['class' => "form-control", 'placeholder' => Carbon\Carbon::now()->format('Y-m-d\TH:i')]) }}
		@endif

		@if ($errors->has('begin'))
		<span class="help-block">
			<strong>{{ $errors->first('begin') }}</strong>
		</span>
		@endif
	</div>
</div>