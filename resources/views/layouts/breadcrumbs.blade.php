@if (isset($breadcrumbs))
<ol class="breadcrumb">
	@if (array_key_exists('sponrun',$breadcrumbs))
	<li>
		<a href="{{ route('sponrun.show',[$breadcrumbs['sponrun']->id]) }}">
			{{ $breadcrumbs['sponrun']->name }}
		</a>
	</li>
	@if (array_key_exists('runpart',$breadcrumbs))
	<li>
		<a href="{{ route('sponrun.runpart.edit',[$breadcrumbs['sponrun']->id,$breadcrumbs['runpart']->id]) }}">
			{{ $breadcrumbs['runpart']->user->lastname }}, {{ $breadcrumbs['runpart']->user->firstname }}
		</a>
	</li>
	@if (array_key_exists('sponsor',$breadcrumbs))
	<li>
		<a href="{{ route('sponrun.runpart.sponsor.edit',[$breadcrumbs['sponrun']->id,$breadcrumbs['runpart']->id,$breadcrumbs['sponsor']->id]) }}">
			{{ $breadcrumbs['sponsor']->lastname }}, {{ $breadcrumbs['sponsor']->firstname }}
		</a>
	</li>
	@endif
	@endif
	@endif
</ol>
@endif