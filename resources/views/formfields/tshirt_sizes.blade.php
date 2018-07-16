<div class="form-group">
	{{ Form::label('tshirt_size', 'T-Shirt-Größe') }}


	<div>
		{{ Form::select('tshirt_size', [NULL => 'Bitte Auswählen','XS'=>'XS', 'S'=>'S', 'M'=>'M', 'L'=>'L', 'XL'=>'XL', 'XXL'=>'XXL'],
			$selectedSize, [ 'class' => "form-control".($errors->has('tshirt_size') ? ' is-invalid' : '') ]) }}

		@if ($errors->has('tshirt_size'))
		<div class="invalid-feedback">
			{{ $errors->first('tshirt_size') }}
		</div>
		@endif
	</div>
</div>