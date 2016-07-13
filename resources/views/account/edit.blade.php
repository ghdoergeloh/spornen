@extends('layouts.app')
@section('title')
- Profil bearbeiten
@endsection
@section('content')
<div class="container">
    <div class="row">         
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Registrieren</div>
				<div class="panel-body">
					{{ Form::model($user, ['route' => 'account.update',	'class' => "form-horizontal"]) }}
					@include('auth.userForm')
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
