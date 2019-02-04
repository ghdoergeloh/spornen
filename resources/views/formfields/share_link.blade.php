<div class="form-group">
	{{ Form::label('share_link', 'Link zum Teilen'.(isset($required) && $required ?' *':'')) }}

	<div class="input-group">
		{{ Form::output('share_link', null, [
			'id' => 'share-link',
			'class' => 'form-control'
		]) }}
		<div class="input-group-append">
			<button id="share-link-button" class="btn btn-outline-secondary" type="button">
				<span class='fa fa-share-alt form-control-feedback'
					aria-hidden='true'></span> Kopieren
			</button>
		</div>
	</div>
</div>