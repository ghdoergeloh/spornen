@include('formfields.firstname')
@include('formfields.lastname')
@include('formfields.street_housenumber')
@include('formfields.postcode_city')
@include('formfields.phone')
@include('formfields.email')
@include('formfields.donation_per_lap')
@include('formfields.donation_static_max')

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<a type="submit" class="btn btn-default" href="{{route('runpart.sponsor.index', $runId)}}">Abbrechen</a>
		{{ Form::submit('Speichern', [ 'class' => "btn btn-primary"]) }}
	</div>
</div>
@include('sponsors.calculation_dlg')