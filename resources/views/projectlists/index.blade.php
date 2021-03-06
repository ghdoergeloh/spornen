@extends('layouts.app')
@section('title')
- Projektlisten
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header">Projektlisten</div>
			<div class="card-body">
				<a class="btn btn-primary" href="{{route('projectlist.create') }}">Neue Projektliste anlegen</a>
				<hr>
				<div class="table-responsive">
					<table class="table table-striped" cellspacing="0">
    					<thead>
        					<tr>
        						<th class="hidden-xs">Projektliste</th>
        						<th></th>
        					</tr>
    					</thead>
    					<tbody>
        					@foreach ($projectlists as $projectlist)
        					<tr class="clickable-row">
        						<td onclick="window.document.location = '{{route('projectlist.show', [$projectlist->id]) }}';">
        							{{ $projectlist->name }}</td>
        						<td class="action-cell">
        							<a class="btn btn-success"
        							   href="{{route('projectlist.edit', [$projectlist]) }}"
        							   data-toggle="tooltip" title="Bearbeiten">
        								<span class="fa fa-pencil"/></a>
        							<a class="btn btn-danger"
        							   href=""
        							   data-toggle="tooltip" title="Löschen "
        							   onclick="event.preventDefault();
                                               if (confirm('Die Projektliste wird gelöscht.')) {
                                                   document.getElementById('delete-projectlist-form{!! $projectlist->id !!}').submit();
                                               }">
        								<span class="fa fa-trash"/></a>
        							{{ Form::open([
        								'method' => 'DELETE',
        								'url' => route('projectlist.destroy', [$projectlist->id]),
        								'class' => "hidden",
        								'id' => 'delete-projectlist-form'.$projectlist->id
        							]) }}
        							{{ Form::close() }}
        						</td>
        					</tr>
        					@endforeach
    					</tbody>
    				</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
