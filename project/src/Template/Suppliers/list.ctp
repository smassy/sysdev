<h1>Manage Suppliers</h1>
<h2>Current Suppliers</h2>
<table class="manageSecondary" id="suppliersTable">
<thead>
<tr>
<th>Name</th>
<th>Associations</th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<?php foreach ($suppliers as $supplier): ?>
<tr>
<td class="name">
<?php echo $supplier->name ?>
</td>
<td>
<?php echo $supplier->count ?>
</td>
<td>
<button class="editAction" id="edit-<?php echo urlencode(str_replace("-", "__", $supplier->name)) . "-" . $supplier->id?>">Edit</button>
</td>
<td>
<?php echo $supplier->count > 0 ? "<button class=\"noDelete\" onclick=\"alert('All associations must be removed before a supplier can be deleted.')\">?</button>" : $this->Form->postLink("<button>Delete</button>", ["action" => "delete", $supplier->id], ["escape" => false, "role" => "button", "class" => "delAction", "confirm" => "Do you really want to delete this supplier?"]) ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<div id="editDiv">
<h2>Edit supplier</h2>
<?php
echo $this->Form->create($blankSupplier, ["url" => "/suppliers/edit/", "class" => "simpleForm"]);
echo $this->Form->control("name");
echo $this->Form->button(__("Update supplier"));
echo $this->Form->button(__("Cancel"), ["id" => "cancelEdit", "type" => "button"]);
echo $this->Form->end();
?>
</div>
<div id="addDiv">
<h2>New supplier</h2>
<?php
echo $this->Form->create($blankSupplier, ["url" => "/suppliers/new", "class" => "simpleForm"]);
echo $this->Form->control("name");
echo $this->Form->button(__("Create supplier"));
echo $this->Form->end();
?>
</div>
<?php echo $this->Html->script("/js/editFormMagic"); ?>
