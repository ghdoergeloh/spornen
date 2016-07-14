@extends('layouts.app')
@section('title')
- Sponsor bearbeiten
@endsection
@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		{{ Form::model($sponsor, [
		'method' => 'PATCH',
		'route' => ['runpart.sponsor.update', $runId, $sponsor->id],
		'class' => "form-horizontal"]) }}
		@include('sponsors.sponsorForm')
		{{ Form::close() }}
	</div>
</div>
@endsection
