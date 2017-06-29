@include('formfields.name', ['required' => true])
@include('formfields.begin', ['required' => true])
@include('formfields.end', ['required' => true])
@include('formfields.with_tshirt', ['required' => true])
@include('formfields.street_housenumber')
@include('formfields.postcode_city')
@include('formfields.description')

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<a type="submit" class="btn btn-default" href="{{route($root_route.'sponrun.index')}}">Abbrechen</a>
		{{ Form::submit('Speichern', [ 'class' => "btn btn-primary"]) }}
	</div>
</div>