@include('formfields.name', ['required' => true])

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<a type="submit" class="btn btn-default" href="{{route('projectlist.index')}}">Abbrechen</a>
		{{ Form::submit('Speichern', [ 'class' => "btn btn-primary"]) }}
	</div>
</div>