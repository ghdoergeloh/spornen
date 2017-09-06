@extends('layouts.app')
@section('title')
- Registrieren
@endsection
@section('content')
<div class="row">            
	<div class="col-md-4">
		<img class="img-responsive" alt="To All Nations" src="{{ url('/images/logo.jpg') }}">
	</div>
	<div class="col-md-6 col-md-offset-1">
		<div class="card card-default">
			<div class="card-header">E-Mail Bestätigen</div>
			<div class="card-body">
				Dir wurde soeben eine E-Mail zugesandt. Bitte klicke auf den Link in der Mail,
				um deine E-Mail zu bestätigen und die Registrierung abzuschließen.
                                Bei Schwierigkeiten wenden Sie sich bitte an
                                <a href="mailto:{{ env('MAIL_WEBMASTER') }}">{{ env('MAIL_WEBMASTER') }}</a>.
			</div>
		</div>
	</div>
</div>
@endsection
