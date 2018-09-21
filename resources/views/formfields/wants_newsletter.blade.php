<div class="form-group">
	<div class="form-check">
		<label class="form-check-label">
			{{ Form::hidden('wants_newsletter', 0) }}
			{{ Form::checkbox('wants_newsletter', 1, null, [ 'class' => 'form-check-input' ]) }}
			möchte regelmäßige Informationen per Newsletter bekommen.
		</label>
	</div>
</div>