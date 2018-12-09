function validateUnit(input, isWhole) {
	if (isWhole) {
		$(input).attr("step", 1);
		$(input).val($(input).val().replace(new RegExp("\\..*"), ""));
	} else {
		$(input).attr("step", 0.25);
	}
	$(input).unbind("keydown");
	$(input).keydown(function (event) {
		if (event.which === 173) {
			alert("Negative values are not allowed.");
			event.preventDefault();
		} else if (isWhole && event.which === 190) {
			alert("No decimals allowed with this unit.");
			event.preventDefault();
		}
	})
}
