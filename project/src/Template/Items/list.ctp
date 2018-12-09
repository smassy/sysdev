<script>
// This ensure that sorting prefs are reloaded.
'use strict';
var relaySuccess = false;
if (location.search === "?success=1") {
	relaySuccess = true;
}

if ((relaySuccess || window.location.search === "") && localStorage["dashboardQstring"] && localStorage["dashboardQstring"] !== "") {
	window.location = window.location.toString().replace(new RegExp("\\?.*"), "") + localStorage["dashboardQstring"] + (relaySuccess ? "&success=2" : "");
}
var printView = <?= isset($print) ? "true" : "false"?>;
</script>
<h2>Dashboard</h2>
<div id="messageDiv">
</div>
<div id="searchWidgetDiv">
<form id="searchForm">
<label id="searchLabel" for="searchField">Search</label>
<input type="text" id="searchField" name="searchText" />
<button type="reset" onclick="$('#searchResultsDiv').hide()">Clear</button>
</form>
</div>
<div id="searchResultsDiv">
<p id="noResult">No matches found.</p>
<ul id="searchResultsList">
<li id="searchResults">Search results:</li>
</ul>
</div>
<div id="sortOptionsDiv">
<label id="sortLabel" for="sortSelect">Sort by</label>
<select id="sortSelect" name="sortSelect">
<option value="name" <?= ($sort == "name") ? 'selected="selected"' : ""?>>Name</option>
<option value="qty" <?= ($sort == "qty") ? 'selected="selected"' : ""?>>Quantity</option>
<option value="thresh_delta" <?= ($sort == "thresh_delta") ? 'selected="selected"' : ""?>>Restock Urgency</option>
<option value="last_added" <?= ($sort == "last_added") ? 'selected="selected"' : ""?>>Stock Age</option>
<option value="supplier" <?= ($sort == "supplier") ? 'selected="selected"' : ""?>>Supplier</option>
</select>
<input type="checkbox" id="reverseCheckbox" name="reverseCheckbox" value="desc" <?= ($order == SORT_DESC) ? 'checked="checked"' : ""?>/> <label id="reverseLabel" for="reverseCheckbox">Reverse</label>
<input type="checkbox" name="showCategories" id="showCategories" value="true" <?= !(isset($all)) ? 'checked="checked"' : ""?> /><label id="showCategoriesLabel" for="showCategories">Categories</label>
</div>
<div id="categoriesDiv">
<ul id="categoriesList">
<?php foreach ($categories as $category): ?>
<?php if (isset($all) || sizeof($category->items) > 0): ?>
<li class="categoryName"><?= (isset($all) ? "All Items" : $category->name) ?>
<div class="row">
<ul class="header">
<li class="heading">Name</li>
<li class="heading">Supplier</li>
<li class="heading">Qty</li>
<li class="heading">Stock Age</li>
</ul>
</div>
<?php 
if (isset($sort)) {
$condition = array();
foreach ($category->items as $key => $item) {
	if ($sort == "supplier") {
		$condition[$key] = $item["supplier"]["name"];
	} else {
		$condition[$key] = $item[$sort];
	}
}
array_multisort($condition, $order, $category->items);
}
?>
<?php foreach ($category->items as $item): ?>
<?php
$stockClass = "";
if ($item->qty > $item->threshold) {
	$stockClass = "inStock";
} elseif ($item->qty == 0) {
	$stockClass = "noStock";
} else {
	$stockClass = "lowStock";
}
?>
<div class="row">
<ul class="item <?= $stockClass ?>" id="<?= "item-" . $item->id ?>">
<li class="itemName"><?= $this->Html->link($item->name, ["action" => "view", $item->id], ["class" => "viewLink"]) ?></li>
<li class="itemSupplier"><?= $item->supplier->name ?></li>
<li class="itemQty"><button class="itemQtyNum" onclick="showUPdateField(<?= $item->id . "," . $item->qty . ",'" . $item->unit->name . "'," . $item->unit->is_whole?>)"><?= $item->qty ?></button>&nbsp;<span class="itemUnit"><?=$item->unit->name?></span></li>
<li class="stockAge"><?= $item->getDaysSinceArrived() > -1 ? $item->getDaysSinceArrived() . "D" : "-" ?></li>
</ul>
</div>
<?php endforeach; ?>
</li>
<?php endif; ?>
<?php endforeach; ?>
</ul>
</div>
<div id="updateDiv">
<?php
echo $this->Form->create($blankItem, ["url" => "/items/edit/", "id" => "updateForm"]);
echo $this->Form->control("qty", ["id" => "updateField", "min" => "0"]);
echo $this->Form->button("save", ["class" => "submitBtn"]);
echo $this->Form->button("Dismiss", ["type" => "button", "onclick" => "dismiss()", "class" => "dismissBtn"]);
echo $this->Form->end();
?>
</div>
<?= $this->Html->script("dashboard") ?>
