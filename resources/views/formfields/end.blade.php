<div class="form-group">
	{{ Form::label('end', 'Ende'.(isset($required) && $required ?' *':'')) }}

	<div>
		@if(isset($required) && $required)
		{{ Form::datetimelocal('end', null, [ 'class' => "form-control".($errors->has('end') ? ' is-invalid' : ''), 'placeholder' => Carbon\Carbon::now()->format('Y-m-d\TH:i'), 'required' => "required" ]) }}
		@else
		{{ Form::datetimelocal('end', null, [ 'class' => "form-control".($errors->has('end') ? ' is-invalid' : ''), 'placeholder' => Carbon\Carbon::now()->format('Y-m-d\TH:i')]) }}
		@endif

		@if ($errors->has('end'))
		<div class="invalid-feedback">
			{{ $errors->first('end') }}
		</div>
		@endif
	</div>
</div>