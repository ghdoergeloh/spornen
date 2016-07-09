@extends('layouts.app')
@section('title')
- Sponsor bearbeiten
@endsection
@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		{!! Form::open([
		'method' => 'POST',
		'route' => ['runpart.sponsor.store', $runId],
		'class' => "form-horizontal"]) !!}
		<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
			{!! Form::label('firstname', 'Vorname', [ 'class' => "col-sm-2 control-label"]) !!}
			<div class="col-sm-10">
				{!! Form::text('firstname', null, [ 'class' => "form-control"]) !!}
				@if ($errors->has('firstname'))
				<span class="help-block">
					<strong>{{ $errors->first('firstname') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
			{!! Form::label('lastname', 'Nachname', [ 'class' => "col-sm-2 control-label"]) !!}

			<div class="col-sm-10">
				{!! Form::text('lastname', null, [ 'class' => "form-control"]) !!}

				@if ($errors->has('lastname'))
				<span class="help-block">
					<strong>{{ $errors->first('lastname') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('street') || $errors->has('housenumber') ? ' has-error' : '' }}">
			{!! Form::label('street', 'Straße, Nr.', [ 'class' => "col-sm-2 control-label"]) !!}
			<div class="col-sm-10">
				{!! Form::text('street', null, [ 'class' => "form-control", 'style' => "width: calc( 70% - 1px ); display: inline-block;"]) !!}
				{!! Form::number('housenumber', null, [ 'class' => "form-control", 'style' => "width: calc( 30% - 2px ); display: inline-block;"]) !!}

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
			{!! Form::label('postcode', 'PLZ, Ort', [ 'class' => "col-sm-2 control-label"]) !!}

			<div class="col-sm-10 " >
				{!! Form::text('postcode', null, [ 'class' => "form-control", 'style' => "width: calc( 30% - 2px ); display: inline-block;"]) !!}
				{!! Form::text('city', null, [ 'class' => "form-control", 'style' => "width: calc( 70% - 1px ); display: inline-block;"]) !!}

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
			{!! Form::label('phone', 'Telefon', [ 'class' => "col-sm-2 control-label"]) !!}

			<div class="col-sm-10">
				{!! Form::text('phone', null, [ 'class' => "form-control"]) !!}

				@if ($errors->has('phone'))
				<span class="help-block">
					<strong>{{ $errors->first('phone') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			{!! Form::label('email', 'E-Mail Addresse', [ 'class' => "col-sm-2 control-label"]) !!}

			<div class="col-sm-10">
				{!! Form::text('email', null, [ 'class' => "form-control"]) !!}

				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				<a type="submit" class="btn btn-default" href="{{route('runpart.sponsor.index', $runId)}}">Abbrechen</a>
				{!! Form::submit('Speichern', [ 'class' => "btn btn-primary"]) !!}
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection
