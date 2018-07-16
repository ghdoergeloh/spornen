@if (isset($projects) && count($projects) > 1)
<div class="form-group">
	{{ Form::label('project_id', 'Unterstütztes Projekt') }}

	
	<div>
		{{ Form::select('project_id', $projects, $selectedProjectId,
			[ 'class' => "form-control custom-select".($errors->has('project_id') ? ' is-invalid' : '') ]) }}

		@if ($errors->has('project'))
		<div class="invalid-feedback">
			{{ $errors->first('project_id') }}
		</div>
		@endif
	</div>
</div>
@endif