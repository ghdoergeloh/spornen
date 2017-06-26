<div class="form-group has-feedback{{ $errors->has('laps') ? ' has-error' : '' }}">
	{{ Form::label('share_link', 'Link zum teilen'.(isset($required) && $required ?' *':''), [ 'class' => "col-md-4 control-label"]) }}

	<div class="col-md-6 " >
		{{ Form::output('share_link', null, [ 'class' => 'form-control']) }}
		<span class="glyphicon glyphicon-share-alt form-control-feedback" aria-hidden="true"></span>
	</div>
</div>