<div class="panel panel-default">
	<div class="panel-heading">Registrieren</div>
	<div class="panel-body">
		{{ Form::open([
		'method' => 'POST',
		'url' => 'login',
		'class' => "form-horizontal"]) }}
		@include('auth.userForm')
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