@include('formfields.firstname', ['required' => true])
@include('formfields.lastname', ['required' => true])
@include('formfields.street_housenumber', ['required' => true])
@include('formfields.postcode_city', ['required' => true])
@include('formfields.phone')
@include('formfields.email')
@include('formfields.donation_per_lap', ['required' => true])
@include('formfields.donation_static_max', ['required' => true])

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<a type="submit" class="btn btn-default" href="{{route('runpart.sponsor.index', $runId)}}">Abbrechen</a>
		{{ Form::submit('Speichern', [ 'class' => "btn btn-primary"]) }}
	</div>
</div>
@include('sponsors.calculation_dlg')