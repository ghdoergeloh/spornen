<div class="modal fade" id="newsletter_dlg" data-backdrop="static"
	data-keyboard="false" tabindex="-1" role="dialog"
	aria-labelledby="calculation_dlg_lbl">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="calculation_dlg_lbl">Newsletter</h5>
			</div>
			<div class="modal-body">
				{{ Form::open([ 'method' => 'PATCH', 'route' => 'account.update', 'class' => "ajax-submit"])
				}}
				<p>Wir senden regelmäßig Informationen über unsere Arbeit als
					Newsletter an alle, die mehr darüber erfahren möchten oder immer
					auf dem Laufenden gehalten werden möchten.</p>
				@include('formfields.wants_newsletter')

				<div class="modal-footer">
					{{ Form::submit('Fertig', [ 'class' => "btn btn-primary" ]) }}
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>