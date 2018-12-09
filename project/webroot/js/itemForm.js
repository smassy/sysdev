'use strict';

var manageWindow;
var state = {};

/*
 * Convenience wrapper for opening manage windows.
 */
function manage(type) {
	manageWindow = window.open("/" + type + "/list", "_blank", type, "menubar=0,status=0");
}

// Save form state before reload
function saveState() {
	$("form input, form select").each(function () {
		if ($(this).attr("id")) {
			state[$(this).attr("id")] =  $(this).val();
			if ($(this).is(":focus")) {
				state["focus"] = $(this).attr("id");
			}
		}
	});
	sessionStorage["itemForm"] = JSON.stringify(state);
}

// Restore saved state and clear the record.
function restoreState() {
	if (sessionStorage["itemForm"] !== undefined) {
		state = JSON.parse(sessionStorage["itemForm"]);
		for (var key  in state) {
			if (key === "focus") {
				$("#" + state[key]).focus();
			} else {
				$("#" + key).val(state[key]);
			}
		}
		delete sessionStorage["itemForm"];
	}
	if (sessionStorage["itemForm"]) {
		console.log("This shouldn't have happened.");
	}
}

/*
 * This function gets called when the manage window closes.
*/
function reload() {
	saveState();
	location.reload(true);
}

$(document).ready(function () {
	restoreState();
});

$("#uniSelect").change(function () {
	var isWhole = units[$(this).val()]["is_whole"];
	validateUnit($("#itemQty"), isWhole);
	validateUnit($("#itemThreshold"), isWhole);
});




