<div class="card card-default">
	<div class="card-header">Registrieren</div>
	<div class="card-body">
		{{ Form::open([
		'method' => 'POST',
		'url' => 'register',
		'class' => "form-horizontal"]) }}
		@include('auth.userForm')
		@include('formfields.email', ['required' => true])
		@include('formfields.password', ['required' => true])
		@include('formfields.password_confirmation', ['required' => true])
		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-btn fa-user"></i> Registrieren
				</button>
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>