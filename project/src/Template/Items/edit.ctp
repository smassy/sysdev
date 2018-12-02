<h2>Update Item</h2>
<div id="itemForm">
<?php
echo $this->Form->create($item);
echo $this->Form->control("name", ["id" => "itemName"]); ?>
<div class="select" id="catDiv">
<label id="catLabel" class="optLabel" for="catSelect">Category</label> <?= $this->Form->select("Items.category_id", $categories->combine("id", "name"), ["id" => "catSelect"]); ?>
<button class="manageBtn" type="button" onclick="manage('categories')">Manage</button>
</div>
<div class="select" id="supDiv">
<label id="supLabel" class="optLabel" for="supSelect">Supplier</label> <?= $this->Form->select("Items.supplier_id", $suppliers->combine("id", "name"), ["id" => "supSelect"]); ?>
<button class="manageBtn" type="button" onclick="manage('suppliers')">Manage</button>
</div>
<?php echo $this->Form->control("qty", ["label" => "Quantity", "id" => "itemQty"]);
echo $this->Form->control("threshold", ["label" => "Low stock threshold", "id" => "itemThreshold"]); ?>
<div class="select" id="uniDiv">
<label id="uniLabel" class="optLabel" for="uniSelect">Unit</label> <?= $this->Form->select("Items.unit_id", $units->combine("id", "name"), ["id" => "uniSelect"]); ?>
<button class="manageBtn" type="button" onclick="manage('units')">Manage</button>
</div>
<?php
echo $this->Form->button(__("Save Item"));
echo $this->Form->button(__("Undo"), ["type" => "reset", "id" => "clearBtn"]);
echo $this->Form->button(__("Cancel"), ["type" => "button", "id" => "cancelBtn", "onclick" => "window.location='/items/list'"]);
echo $this->Form->end();
echo $this->Html->script("itemForm");
?>
<script>
<?php
echo "var units = {};\n";
foreach ($units as $unit) {
	echo "units[" . $unit->id . "] = {'name': '" . $unit->name . "', 'is_whole': " . (($unit->is_whole == 1) ? "true" : "false") . "};\n";
}
?>
</script>
</div>
