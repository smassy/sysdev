<h2>Dashboard</h2>
<div id="messageDiv">
Stock messages go here.<br/><?= isset($sort) ? $sort : "NONE"?><?= $order ?>
</div>
<div id="searchWidgetDiv">
SearchWidget goes here.
</div>
<div id="searchResultsDiv">
Search results will appear here if there is a search term in the widget.
</div>
<div id="sortOptionsDiv">
<label id="sortLabel" for="sortSelect">Sorty by</label>
<select id="sortSelect" name="sortSelect">
<option value="name">Name</option>
<option value="qty">Quantity</option>
<option value="tresh_delta">Threshold Distance</option>
<option value="last_added">Stock Age</option>
</select>
<input type="checkbox" id="reverseCheckbox" name="reverseCheckbox" value="desc" /> <label id="reverseLabel" for="reverseCheckbox">Reverse</label>
<input type="checkbox" name="showCategories" id="showCategories" value="true" checked="checked" /><label id="showCategoriesLabel" for="showCategories">Categories</label>
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
	$condition[$key] = $item[$sort];
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
<li class="itemQty"><span class="itemQtyNum"><?= $item->qty ?></span>&nbsp;<span class="itemUnit"><?=$item->unit->name?></span></li>
<li class="stockAge"><?= $item->getDaysSinceArrived() > -1 ? $item->getDaysSinceArrived() . "D" : "-" ?></li>
</ul>
</div>
<?php endforeach; ?>
</li>
<?php endif; ?>
<?php endforeach; ?>
</ul>

</div>
