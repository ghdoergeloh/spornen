@if(Session::has('messages-success'))
@foreach (Session::get('messages-success')->all() as $message)
<div class="alert alert-success" role="alert">{{ $message }}</div>
@endforeach
{{ Session::flash('messages-success',null) }}
@endif
@if(Session::has('messages-info'))
@foreach (Session::get('messages-info')->all() as $message)
<div class="alert alert-info" role="alert">{{ $message }}</div>
@endforeach
{{ Session::flash('messages-info',null) }}
@endif
@if(Session::has('messages-warning'))
@foreach (Session::get('messages-warning')->all() as $message)
<div class="alert alert-warning" role="alert">{{ $message }}</div>
@endforeach
{{ Session::flash('messages-warning',null) }}
@endif
@if(Session::has('messages-danger'))
@foreach (Session::get('messages-danger')->all() as $message)
<div class="alert alert-danger" role="alert">{{ $message }}</div>
@endforeach
{{ Session::flash('messages-danger',null) }}
@endif