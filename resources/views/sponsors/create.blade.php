@extends('layouts.app')
@section('title')
- Sponsor anlegen
@endsection
@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		{{ Form::open([
		'route' => ['runpart.sponsor.store', $runId],
		'class' => "form-horizontal"]) }}
		@include('sponsors.sponsorForm')
		{{ Form::close() }}
	</div>
</div>
@endsection
