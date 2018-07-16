@include('formfields.name', ['required' => true])
@include('formfields.scope', ['required' => true])

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<a type="submit" class="btn btn-secondary" href="{{route('project.index')}}">Abbrechen</a>
		{{ Form::submit('Speichern', [ 'class' => "btn btn-primary"]) }}
	</div>
</div>