@extends('layouts.app')
@section('title')
- Sponsorenläufe
@endsection
@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Sponsorenläufe</div>
                <div class="panel-body">
					<table class="table table-striped">
						<tr>
							<th>Datum</th>
							<th>Name</th>
							<th>Gelaufene Runden</th>
							<th>Sponsoren</th>
						</tr>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
