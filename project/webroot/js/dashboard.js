'use strict';
var baseForm;
var form;

$("#sortSelect, #reverseCheckbox, #showCategories").change(function () {
	var newLoc = window.location.toString();
	var qString = getQueryString();
	localStorage["dashboardQstring"] = qString;
	newLoc = newLoc.replace(new RegExp("\\?.*"), "") + qString;
	window.location = newLoc;
});

/*
 * Create a query string based on selected options on the dashboard.
*/
function getQueryString() {
	var qString = "?";
	var sortVal = $("#sortSelect").val();
	if (sortVal !== "name" ) {
		qString += "sort=" + sortVal;
	}
	if ($("#reverseCheckbox").prop("checked")) {
		qString += (qString.length > 1) ? "&" : "";
		qString += "order=desc";
	}
	if (!$("#showCategories").prop("checked")) {
		qString += (qString.length > 1) ? "&" : "";
		qString += "all=1";
	}
	return (qString.length > 1) ? qString : "";
}

/*
 * Executed when a qty button is clicked.
 * Shows the form to update the item's qty.
*/
function showUPdateField(id, oldQty, unit, isWhole) {
	if (form) {
		alert("Concurrent updates are not supported at the moment. Please save or dismiss the currently active update field");
		return;
	}
	isWhole = (isWhole === 1 ? true : false);
	var item = $("#item-" + id);
	$(item).find(".stockAge").hide();
	var itemLi = $(item).find(".itemQty");
	$(itemLi).find("button").hide()
	form = $(baseForm).clone();
	$(form).attr("id", "update-" + id);
	$(form).find("form").attr("action", "/items/edit/" + id);
	$(form).find(".dismissBtn").attr("onclick", "dismiss(" + id + ")");
	$(form).find("#updateField").val(oldQty);
	$(itemLi).prepend(form);
	$(form).show();
	$(form).find("#updateField").focus();
	validateUnit($(form).find("#updateField"), isWhole);
}

function dismiss(id) {
	if (form) {
		$(form).remove();
		form = null;
		$("#item-" + id + " button").show();
		$("#item-" + id + " .stockAge").show();
	}
}

function populateMessageDiv() {
	var lowStock = $(".lowStock").length;
	var noStock = $(".noStock").length;
	if (lowStock == 0 && noStock && 0) {
		$("#messageDiv").hide();
		return;
	}
	if (noStock > 0) {
		$("#messageDiv").append('<p class="noStockAler">There ' + ((noStock === 1) ? "is " : "are ") + noStock + ((noStock === 1) ? " item" : " items") + ' currently <strong>out of stock</strong>.');
	}
	if (lowStock > 0) {
		$("#messageDiv").append('<p class="lowStockAler">There ' + ((lowStock === 1) ? "is " : "are ") + lowStock + ((lowStock === 1) ? " item" : " items") + ' currently <strong>understocked</strong>.');
	}
}

$(document).ready(function () {
	baseForm = $("#updateDiv");
	$(baseForm).remove();
	populateMessageDiv();
});

function validateUnit(input, isWhole) {
	if (isWhole) {
		$(input).attr("step", 1);
	} else {
		$(input).attr("step", 0.25);
	}
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
