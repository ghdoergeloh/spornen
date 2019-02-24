@extends('layouts.app')
@section('title')
- E-Mail-Adresse bestätigen
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('E-Mail-Adresse bestätigen') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Ein neuer Bestätigungslink wurde dir per Mail zugeschickt.') }}
                        </div>
                    @endif
                    {{ __('Bevor Du fortfährst, schaue bitte in Deine E-Mails nach einem Link zur Bestätigung Deiner E-Mail-Adresse.') }}
                    {{ __('Falls Du die E-Mail nicht erhalten hast') }}, <a href="{{ route('verification.resend') }}">{{ __('klicke hier um eine neue zuerhalten') }}</a>.
                    {{ __('Bei Schwierigkeiten wende Dich bitte an') }} <a href="mailto:{{ env('MAIL_WEBMASTER') }}">{{ env('MAIL_WEBMASTER') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
