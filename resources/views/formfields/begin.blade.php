<div class="form-group">
	{{ Form::label('firstname', 'Beginn'.(isset($required) && $required ?' *':'')) }}

	<div>
		@if(isset($required) && $required)
		{{ Form::datetimelocal('begin', null , ['class' => "form-control".($errors->has('begin') ? ' is-invalid' : ''),
			'placeholder' => Carbon\Carbon::now()->format('Y-m-d\TH:i'), 'required' => "required"]) }}
		@else
		{{ Form::datetimelocal('begin', null , ['class' => "form-control".($errors->has('begin') ? ' is-invalid' : ''),
			'placeholder' => Carbon\Carbon::now()->format('Y-m-d\TH:i')]) }}
		@endif

		@if ($errors->has('begin'))
		<div class="invalid-feedback">
			{{ $errors->first('begin') }}
		</div>
		@endif
	</div>
</div>