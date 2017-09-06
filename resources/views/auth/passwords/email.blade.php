@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-default">
                <div class="card-header">Passwort zurücksetzen</div>
                <div class="card-body">
					{{ Form::open([
					'method' => 'POST',
					'url' => 'password/email',
					'class' => "form-horizontal"]) }}
					{{ csrf_field() }}
					@include('formfields.email')
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							{{ Form::button('<i class="fa fa-btn fa-envelope"></i> Link zum Zurücksetzen senden', ['type' => 'submit', 'class' => "btn btn-primary"]) }}
						</div>
					</div>
					{{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
