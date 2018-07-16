@extends('layouts.app')
@section('title')
- Sponsor bearbeiten
@endsection
@section('content')
<div class="col-md-8">
	{{ Form::model($sponsor, [
		'method' => 'PATCH',
		'url' => route($root_route.'sponsor.update', array_merge($root_route_params, [$sponsor->id]))]) }}
	@include('sponsors.sponsorForm')
	{{ Form::close() }}
</div>
@endsection
