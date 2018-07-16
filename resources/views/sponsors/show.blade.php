@extends('layouts.app')
@section('title')
- Sponsor anzeigen
@endsection
@section('content')
<div class="col-md-8">
	<dl class="dl-horizontal">
		<dt>Vorname</dt>
		<dd>{{ $sponsor->firstname }}</dd>
	</dl>
	<dl class="dl-horizontal">
		<dt>Nachname</dt>
		<dd>{{ $sponsor->lastname }}</dd>
	</dl>
	<dl class="dl-horizontal">
		<dt>Straße, Nr.</dt>
		<dd>{{ $sponsor->street }} {{ $sponsor->housenumber }}</dd>
	</dl>
	<dl class="dl-horizontal">
		<dt>PLZ, Ort</dt>
		<dd>{{ $sponsor->postcode }} {{ $sponsor->city }}</dd>
	</dl>
	<dl class="dl-horizontal">
		<dt>Telefon</dt>
		<dd>{{ $sponsor->phone }}</dd>
	</dl>
	<dl class="dl-horizontal">
		<dt>E-Mail-Adresse</dt>
		<dd>{{ $sponsor->email }}</dd>
	</dl>
	<dl class="dl-horizontal">
		<dt>Spende pro Runde</dt>
		<dd>{{ $sponsor->donation_per_lap }} €</dd>
	</dl>
	<dl class="dl-horizontal">
		<dt>Maximal- oder Festbetrag</dt>
		<dd>{{ $sponsor->donation_static_max }} €</dd>
	</dl>
</div>
@endsection
