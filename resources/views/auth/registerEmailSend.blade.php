@extends('layouts.app')
@section('title')
- Registrieren
@endsection
@section('content')
<div class="container">
    <div class="row">            
		<div class="col-md-4">
			<img class="img-responsive" alt="To All Nations" src="{{ url('/images/tan_900.jpg') }}">
		</div>
		<div class="col-md-6 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">E-Mail Bestätigen</div>
				<div class="panel-body">
					Dir wurde soeben eine E-Mail zugesandt. Bitte klicke auf den Link in der Mail,
					um deine E-Mail zu bestätigen und die Registrierung abzuschließen.
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
