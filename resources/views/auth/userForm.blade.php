<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
	{{ Form::label('firstname', 'Vorname', [ 'class' => "col-md-4 control-label"]) }}
	<div class="col-md-6">
		{{ Form::text('firstname', null, [ 'class' => "form-control"]) }}
		@if ($errors->has('firstname'))
		<span class="help-block">
			<strong>{{ $errors->first('firstname') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
	{{ Form::label('lastname', 'Nachname', [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		{{ Form::text('lastname', null, [ 'class' => "form-control"]) }}

		@if ($errors->has('lastname'))
		<span class="help-block">
			<strong>{{ $errors->first('lastname') }}</strong>
		</span>
		@endif
	</div>
</div>

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

<div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
	{{ Form::label('birthday', 'Geburtstag', [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		{{ Form::date('birthday', null, [ 'class' => "form-control"]) }}

		@if ($errors->has('birthday'))
		<span class="help-block">
			<strong>{{ $errors->first('birthday') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
	<div class="col-md-10 col-md-offset-4">
		<div class="radio-inline">
			<label>
				{{ Form::radio('gender', 'm') }}
				Mann
			</label>
		</div>
		<div class="radio-inline">
			<label>
				{{ Form::radio('gender', 'f') }}
				Frau
			</label>
		</div>

		@if ($errors->has('gender'))
		<span class="help-block">
			<strong>{{ $errors->first('gender') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	{{ Form::label('phone', 'Telefon', [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		{{ Form::text('phone', null, [ 'class' => "form-control"]) }}

		@if ($errors->has('phone'))
		<span class="help-block">
			<strong>{{ $errors->first('phone') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	{{ Form::label('email', 'E-Mail Addresse', [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		{{ Form::text('email', null, [ 'class' => "form-control"]) }}

		@if ($errors->has('email'))
		<span class="help-block">
			<strong>{{ $errors->first('email') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	{{ Form::label('password', 'Passwort', [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6">
		{{ Form::password('password', [ 'class' => "form-control"]) }}

		@if ($errors->has('password'))
		<span class="help-block">
			<strong>{{ $errors->first('password') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	<label for="password-confirm" class="col-md-4 control-label">Passwort bestätigen</label>

	<div class="col-md-6">
		{{ Form::password('password_confirmation', [ 'class' => "form-control"]) }}

		@if ($errors->has('password_confirmation'))
		<span class="help-block">
			<strong>{{ $errors->first('password_confirmation') }}</strong>
		</span>
		@endif
	</div>
</div>