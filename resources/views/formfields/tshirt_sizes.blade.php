<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
	{{ Form::label('tshirt_size', 'T-Shirt-Größe', [ 'class' => "col-md-4 control-label"]) }}


	<div class="col-md-6">
		{{ Form::select('tshirt_size', [NULL => 'Bitte Auswählen','XS'=>'XS', 'S'=>'S', 'M'=>'M', 'L'=>'L', 'XL'=>'XL', 'XXL'=>'XXL'], $selectedSize, [ 'class' => "form-control" ]) }}

		@if ($errors->has('tshirt_size'))
		<span class="help-block">
			<strong>{{ $errors->first('tshirt_size') }}</strong>
		</span>
		@endif
	</div>
</div>