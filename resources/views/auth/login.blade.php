@extends('layouts.app')
@section('title')
- Login
@endsection
@section('content')
<div class="row">          
	<div class="col-md-12">
		@include('auth.loginPanel')
	</div>
</div>
@endsection
