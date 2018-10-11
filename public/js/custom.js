$(document).ready(function() {	
	if ($('#newsletter_dlg').length)
	{
		$('#newsletter_dlg').modal('show');
		$('#newsletter_dlg').find('form').bind("afterSubmit",function(e){
			$('#newsletter_dlg').modal('hide');
		});
	}
		
	
	$(function() {
		$('form.ajax-submit').submit(function(event) {
			event.preventDefault();
			var form = this;
			var formData = $(form).serialize();
			$.ajax({
				type : $(form).attr('method'),
				url : $(form).attr('action'),
				dataType : 'JSON',
				data : formData
			})
			.done(function(data) {
				$(form).trigger('afterSubmit');
			})
			.fail(function(data){
				console.log(data);
			});
		});
	});

	$('.editableLaps').click(function(){
		if($(this).children().length == 0){
			var cell = this;
			var row = $(cell).parent();
			var initialLaps = $(cell).text();
			$(cell).text('');

			var div1 = document.createElement('div');
			$(cell).append(div1);
			$(div1).attr('class','input-group');
			
			var input = document.createElement('input');
			$(div1).append(input);
			$(input).attr('class','form-control');
			$(input).attr('type','number');
			$(input).attr('value', initialLaps);
			

			var div2 = document.createElement('div');
			$(div1).append(div2);
			$(div2).attr('class','input-group-append');
			
			var button = document.createElement('button');
			$(div2).append(button);
			$(button).attr('class','btn btn-outline-secondary');
			
			var icon = document.createElement('i');
			$(button).append(icon);
			$(icon).attr('class','fa fa-save');

			$(div1).attr('style', 'width: 120px;');
			
			$(input).focus();
			$(input).select();
			$(input).bind("submit",function(e){
				var runPartId = $(row).attr('row_id');
				var laps = $(input).val();
				var url = indexRunPartURL + "/" + runPartId;
				var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
				var result = $.ajax({
					url : url,
					type : 'PATCH',
					dataType : 'JSON',
					data : {
						_token : CSRF_TOKEN,
						laps : laps
					}
				})
				.done(function(data) {
					$(cell).text(data['laps']);
					$(row).children('td[name=sum]').text(data['sum'] + " €")
				})
				.fail(function(data) {
					$(input).addClass('is-invalid');
				});
			});
			$(input).bind("exit",function(e){
				$(cell).text(initialLaps);
			});
			

			$(input).keyup(function(e) {
				switch(e.keyCode) {
					case 13: // Enter
						$(input).trigger("submit");
						break;
					case 27: // Esc
						$(input).trigger("exit");
						break;
				}
			});
			
			$(document).mouseup(function (e) {
				if (!$(cell).is(e.target) && $(cell).has(e.target).length === 0)
				{
					$(input).trigger("exit");
				}
			});
			
			$(button).click(function(e) {
				$(input).trigger("submit");
			});
		}
	});

	$('.dataTable').DataTable();
});


function selectText(element) {
	var range, selection;
	if (document.body.createTextRange) {
		range = document.body.createTextRange();
		range.moveToElementText(element);
		range.select();
	} else if (window.getSelection) {
		selection = window.getSelection();
		range = document.createRange();
		range.selectNodeContents(element);
		selection.removeAllRanges();
		selection.addRange(range);
	}
}

function copyToClipboard(element) {
	element.select();
	document.execCommand("copy");
	$(element).attr('data-title', "Kopiert").tooltip('show');
}

function disposeTooltip(element, text) {
	$(element).tooltip('dispose');
}