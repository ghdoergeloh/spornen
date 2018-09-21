@include('formfields.firstname', ['required' => true])
@include('formfields.lastname', ['required' => true])
@include('formfields.street_housenumber', ['required' => true])
@include('formfields.postcode_city', ['required' => true])
@include('formfields.phone')
@include('formfields.email')
@include('formfields.donation_per_lap')
@include('formfields.donation_static_max')
@include('formfields.wants_newsletter')

<div class="form-group">
	<div">
		<a type="submit" class="btn btn-secondary" href="{{route($root_route.'sponsor.index', $root_route_params)}}">Abbrechen</a>
		{{ Form::submit('Speichern', [ 'class' => "btn btn-primary"]) }}
	</div>
</div>
@include('sponsors.calculation_dlg')