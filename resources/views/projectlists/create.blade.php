@extends('layouts.app')
@section('title')
- Projektliste anlegen
@endsection
@section('content')
<div class="row">
	<div class="col-md-6 offset-md-2">
		{{ Form::open([
		'url' => route('projectlist.store')]) }}
		@include('projectlists.projectlistForm')
		{{ Form::close() }}
	</div>
</div>
@endsection