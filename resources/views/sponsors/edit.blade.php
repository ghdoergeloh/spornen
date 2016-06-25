@extends('layouts.app')
@section('title')
- Sponsor bearbeiten
@endsection
@section('content')
<div class="container">
	<div class="col-md-6 col-md-offset-2">
		<form class="form-horizontal" role="form" method="POST" action="{{ url('/sponrun/edit') }}">
			{{ csrf_field() }}

			<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
				<label for="firstname" class="col-sm-2 control-label">Vorname</label>

				<div class="col-sm-10">
					<input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}">

					@if ($errors->has('firstname'))
					<span class="help-block">
						<strong>{{ $errors->first('firstname') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
				<label for="lastname" class="col-sm-2 control-label">Nachname</label>

				<div class="col-sm-10">
					<input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">

					@if ($errors->has('lastname'))
					<span class="help-block">
						<strong>{{ $errors->first('lastname') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('street') || $errors->has('housenumber') ? ' has-error' : '' }}">
				<label for="street" class="col-sm-2 control-label">Straße, Nr.</label>
				<div class="col-sm-10">
					<input id="street" type="text" class="form-control" name="street" value="{{ old('street') }}" style="width: calc( 70% - 1px ); display: inline-block;">
					<input id="housenumber" type="number" class="form-control" name="housenumber" value="{{ old('housenumber') }}" style="width: calc( 30% - 2px ); display: inline-block;">

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
				<label for="postcode" class="col-sm-2 control-label">PLZ, Ort</label>

				<div class="col-sm-10 " >
					<input id="postcode" type="text" class="form-control" name="postcode" value="{{ old('postcode') }}" style="width: calc( 30% - 2px ); display: inline-block;">
					<input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" style="width: calc( 70% - 1px ); display: inline-block;">

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

			<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
				<label for="phone" class="col-sm-2 control-label">Telefon</label>

				<div class="col-sm-10">
					<input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}">

					@if ($errors->has('phone'))
					<span class="help-block">
						<strong>{{ $errors->first('phone') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email" class="col-sm-2 control-label">E-Mail Addresse</label>

				<div class="col-sm-10">
					<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

					@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-default">Speichern</button>
					<button type="submit" class="btn btn-default">Abbrechen</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
