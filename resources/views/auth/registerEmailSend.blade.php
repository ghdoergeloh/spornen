@extends('layouts.app')
@section('title')
- Registrieren @endsection
@section('content')
<div class="card card-login mx-auto mt-5">
	<div class="card-header">E-Mail Bestätigen</div>
	<div class="card-body">
		Dir wurde soeben eine E-Mail zugesandt. Bitte klicke auf den Link in
		der Mail, um deine E-Mail zu bestätigen und die Registrierung
		abzuschließen. Bei Schwierigkeiten wende Dich bitte an <a
			href="mailto:{{ env('MAIL_WEBMASTER') }}">{{ env('MAIL_WEBMASTER') }}</a>.
	</div>
</div>
@endsection
