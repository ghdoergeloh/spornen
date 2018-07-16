<div class="form-group">
	{{ Form::label('share_link', 'Link zum Teilen'.(isset($required) && $required ?' *':'')) }}

	<div class="input-group">
		{{ Form::output('share_link', null, [
			'class' => 'form-control'
		]) }}
		<div class="input-group-append">
			<button class="btn btn-outline-secondary"
				type="button" onclick="copyToClipboard($(this).parent().prev());"
				onmouseout="disposeTooltip($(this).parent().prev(), 'Link kopieren');">
				<span class='fa fa-share-alt form-control-feedback'
					aria-hidden='true'></span> Kopieren
			</button>
		</div>
	</div>
</div>