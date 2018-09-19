@include('formfields.name', ['required' => true])
@include('formfields.scope', ['required' => true])

<div class="form-group">
	<a type="submit" class="btn btn-secondary" href="{{route('project.index')}}">Abbrechen</a>
	{{ Form::submit('Speichern', [ 'class' => "btn btn-primary"]) }}
</div>