@include('formfields.name', ['required' => true])

<div class="form-group">
	<a type="submit" class="btn btn-secondary" href="{{route('projectlist.index')}}">Abbrechen</a>
	{{ Form::submit('Speichern', [ 'class' => "btn btn-primary"]) }}
</div>