<h2>Dashboard</h2>
<div -id="messageDiv">
Stock messages go here.
</div>
<div id="searchWidgetDiv">
SearchWidget goes here.
</div>
<div id="sortOptionsDiv">
Sort options will eppear here if there's something to be sorted.
</div>
<div id="searchResultsDiv">
Search results will appear here if there is a search term in the widget.
</div>
<div id="categoriesDiv">
<ul id="categoriesList">
<?php foreach ($categories as $category): ?>
<?php if (sizeof($category->items) > 0): ?>
<li class="categoryName"><?= $category->name ?>
<div class="row">
<ul class="header">
<li class="heading">Name</li>
<li class="heading">Supplier</li>
<li class="heading">Qty</li>
</ul></li>
</div>
<?php foreach ($category->items as $item): ?>
<div class="row">
<ul class="item">
<li class="itemName"><?= $this->Html->link($item->name, ["action" => "view", $item->id], ["class" => "viewLink"]) ?></li>
<li class="itemSupplier"><?= $item->supplier->name ?></li>
<li class="itemQty"><span class="itemQtyNum"><?= $item->qty ?></span>&nbsp;<span class="itemUnit"><?=$item->unit->name?></span></li>
</ul>
</li>
</div>
<?php endforeach; ?>
</li>
<?php endif; ?>
<?php endforeach; ?>
</ul>

</div>
