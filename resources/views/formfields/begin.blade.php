<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
	{{ Form::label('firstname', 'Beginn', [ 'class' => "col-md-4 control-label"]) }}
	<div class="col-md-6">
		{{ Form::datetimelocal('begin', null , ['class' => "form-control", 'placeholder' => Carbon\Carbon::now()]) }}
		@if ($errors->has('begin'))
		<span class="help-block">
			<strong>{{ $errors->first('begin') }}</strong>
		</span>
		@endif
	</div>
</div>