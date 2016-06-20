@extends('layouts.app')
@section('title')
- Sponsoren
@endsection
@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Meine Sponsoren</div>
                <div class="panel-body">
					<table class="table table-striped">
						<tr>
							<th>Nachname</th>
							<th>Vorname</th>
							<th>Straße</th>
							<th>Nr.</th>
							<th>PLZ</th>
							<th>Ort</th>
							<th>Telefon</th>
							<th>E-Mail</th>
							<th>Spende pro Runde</th>
							<th>Maximal- oder Festbetrag</th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
						@foreach ($sponsors as $sponsor)
						<tr>
							<td>{{ $sponsor->lastname }}</td>
							<td>{{ $sponsor->firstname }}</td>
							<td>{{ $sponsor->street }}</td>
							<td>{{ $sponsor->housnumber }}</td>
							<td>{{ $sponsor->postcode }}</td>
							<td>{{ $sponsor->city }}</td>
							<td>{{ $sponsor->phone }}</td>
							<td>{{ $sponsor->email }}</td>
							<td>{{ $sponsor->donation_per_lap }}</td>
							<td>{{ $sponsor->donation_static_max }}</td>
							<td><a class="btn btn-success">Details</a></td>
							<td><a class="btn btn-default">Bearbeiten</a></td>
							<td><a class="btn btn-danger">Löschen</a></td>
						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
