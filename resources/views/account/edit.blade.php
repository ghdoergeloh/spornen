@extends('layouts.app')
@section('title')
- Account bearbeiten
@endsection
@section('content')
<div class="container">
    <div class="row">         
		<div class="col-md-8 col-md-offset-2">
			{{ Form::model($user, ['method' => 'PATCH', 'route' => 'account.update',	'class' => "form-horizontal"]) }}
			@include('auth.userForm')
			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<a type="submit" class="btn btn-default" href="{{route('account.edit')}}">Abbrechen</a>
					{{ Form::submit('Speichern', [ 'class' => "btn btn-primary"]) }}
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@endsection