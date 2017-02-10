@extends('layouts.app')
@section('title')
- Sponsorenlauf bearbeiten
@endsection
@section('content')
<div class="container">
	<div class="col-md-8 col-md-offset-2">
		{{ Form::model($sponrun, [
		'method' => 'PATCH',
		'route' => ['sponrun.update', $sponrun->id],
		'class' => "form-horizontal"]) }}
		@include('sponruns.sponrunForm')
		{{ Form::close() }}
	</div>
</div>
@endsection