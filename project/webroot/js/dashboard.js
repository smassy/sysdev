'use strict';

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


