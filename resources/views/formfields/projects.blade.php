@if (isset($projects) && count($projects) > 1)
<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
	{{ Form::label('project', 'Unterstütztes Projekt', [ 'class' => "col-md-4 control-label"]) }}

	
	<div class="col-md-6">
		{{ Form::select('project', $projects, $selectedProjectId, [ 'class' => "form-control" ]) }}

		@if ($errors->has('project'))
		<span class="help-block">
			<strong>{{ $errors->first('begin') }}</strong>
		</span>
		@endif
	</div>
</div>
@endif