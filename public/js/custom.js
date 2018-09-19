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

$(document).ready(function() {
	$('.dataTable').each(function(index) {
		$(this).DataTable();
	});
});

$(document).ready(function() {
	if ($('#newsletter_dlg').length)
		$('#newsletter_dlg').modal('show');
});