<h2>Create Item</h2>
<div id="itemForm">
<?php
echo $this->Form->create($item);
echo $this->Form->control("name", ["id" => "itemName"]); ?>
<div class="select" id="catDiv">
<label id="catLabel" class="optLabel" for="catSelect">Category</label> <?= $this->Form->select("Items.category_id", $categories->combine("id", "name"), ["empty" => "Choose one...", "id" => "catSelect"]); ?>
<button class="manageBtn" type="button" onclick="manage('categories')">Manage</button>
</div>
<div class="select" id="supDiv">
<label id="supLabel" class="optLabel" for="supSelect">Supplier</label> <?= $this->Form->select("Items.supplier_id", $suppliers->combine("id", "name"), ["empty" => "Choose one...", "id" => "supSelect"]); ?>
<button class="manageBtn" type="button" onclick="manage('suppliers')">Manage</button>
</div>
<?php echo $this->Form->control("qty", ["min" => 0, "label" => "Quantity", "id" => "itemQty"]);
echo $this->Form->control("threshold", ["min" => 0, "label" => "Low stock threshold", "id" => "itemThreshold"]); ?>
<div class="select" id="uniDiv">
<label id="uniLabel" class="optLabel" for="uniSelect">Unit</label> <?= $this->Form->select("Items.unit_id", $units->combine("id", "name"), ["empty" => "choose one...", "id" => "uniSelect"]); ?>
<button class="manageBtn" type="button" onclick="manage('units')">Manage</button>
</div>
<?php
echo $this->Form->button(__("Add Item"));
echo $this->Form->button(__("Clear"), ["type" => "reset", "id" => "clearBtn"]);
echo $this->Form->button(__("Cancel"), ["type" => "button", "id" => "cancelBtn", "onclick" => "window.location='/items/list'"]);
echo $this->Html->script("unitsValidation");
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
<script>
$("form").submit(function (event) {
	var valid = true;
	var firstInvalid = null;
	$("select").each(function () {
		if ($(this).val() === "") {
			valid = false;
			if (!firstInvalid) {
				firstInvalid = this;
			}
		}
	})
	if (!valid) {
		alert("Please ensure that you have selected a category a supplier and a unit.");
		$(firstInvalid).focus();
		event.preventDefault();
		return false;
	}
});
</script>
