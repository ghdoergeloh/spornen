@extends('layouts.app')
@section('title')
 - Home
@endsection
@section('content')
<div class="container">
    <div class="row">            
	<div class="col-md-4">
		<img class="img-responsive" alt="To All Nations" src="../images/tan_900.jpg">
	</div>
		<div class="col-md-6 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
