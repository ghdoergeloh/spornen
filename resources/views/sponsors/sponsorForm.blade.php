@include('formfields.firstname', ['required' => true])
@include('formfields.lastname', ['required' => true])
@include('formfields.street_housenumber', ['required' => true])
@include('formfields.postcode_city', ['required' => true])
@include('formfields.phone')
@include('formfields.email')
@include('formfields.donation_per_lap')
@include('formfields.donation_static_max')

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<a type="submit" class="btn btn-default" href="{{route($root_route.'sponsor.index', $root_route_params)}}">Abbrechen</a>
		{{ Form::submit('Speichern', [ 'class' => "btn btn-primary"]) }}
	</div>
</div>
@include('sponsors.calculation_dlg')