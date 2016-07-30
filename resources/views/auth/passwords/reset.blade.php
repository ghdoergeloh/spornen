@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
					{{ Form::open([
					'method' => 'POST',
					'url' => 'password/reset',
					'class' => "form-horizontal"]) }}
					
					{{ Form::hidden('token', $token) }}

					@include('formfields.email')
					@include('formfields.password')
					@include('formfields.password_confirmation')

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							{{ Form::button('<i class="fa fa-btn fa-refresh"></i> Passwort zurücksetzen', ['type' => 'submit', 'class' => "btn btn-primary"]) }}
						</div>
					</div>
					{{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
