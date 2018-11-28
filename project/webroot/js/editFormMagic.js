/*
 * This file holds some basic JS to handle showing and hiding the edit form in
 * the Categories, Suppliers and Units views.
*/

'use strict';
var baseUrl;

$(document).ready(function () {
	$("#editDiv").hide();
	baseUrl = $("#editDiv form").attr("action");
});

$("#cancelEdit").click(function () {
	resetEditForm();
	$("#editDiv").hide();
});

function resetEditForm() {
	$("#editDiv form").attr("action", baseUrl);
	$("#editDiv form input#name").val("");
	$(".editPending").removeClass("editPending");
}

$(".actionButton").click(function () {
	var info  = decodeURIComponent($(this).attr("id")).replace("+", " ").split("-");
	console.log("INFO: " + info);
	if (info[0] === "edit") {
		resetEditForm();
		$("#editDiv").show();
		$("#editDiv form input#name").val(info[1].replace("__", "-"));
		$("#editDiv form").attr("action", baseUrl + info[2]);
		$("#editDiv form input#name").focus();
		$(this).addClass("editPending");
	} else if (info[0] === "delete") {
		alert("DEBUG: A delete button was pressed");
	}
});

