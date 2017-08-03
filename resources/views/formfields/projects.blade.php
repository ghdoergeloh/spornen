@if (isset($projects) && count($projects) > 1)
<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
	{{ Form::label('project_id', 'Unterstütztes Projekt', [ 'class' => "col-md-4 control-label"]) }}

	
	<div class="col-md-6">
		{{ Form::select('project_id', $projects, $selectedProjectId, [ 'class' => "form-control" ]) }}

		@if ($errors->has('project'))
		<span class="help-block">
			<strong>{{ $errors->first('project_id') }}</strong>
		</span>
		@endif
	</div>
</div>
@endif