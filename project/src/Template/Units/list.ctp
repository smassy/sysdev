<h1>Manage units</h1>
<h2>Current units</h2>
<table class="manageSecondary" id="unitsTable">
<thead>
<tr>
<th>Name</th>
<th>Whole</th>
<th>Associations</th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<?php foreach ($units as $unit): ?>
<tr>
<td class="name">
<?php echo $unit->name ?>
</td>
<td class="<?= $unit->is_whole ? "whole" : "notWhole"?>">
<?php echo $unit->is_whole ? "Yes" : "No" ?>
</td>
<td>
<?php echo $unit->count ?>
</td>
<td>
<button class="editAction" id="edit-<?php echo urlencode(str_replace("-", "__", $unit->name)) . "-" . $unit->id?>">Edit</button>
</td>
<td>
<?php echo $unit->count > 0 ? "<button class=\"noDelete\" onclick=\"alert('All associations must be removed before a unit can be deleted.')\">?</button>" : $this->Form->postLink("<button>Delete</button>", ["action" => "delete", $unit->id], ["escape" => false, "role" => "button", "class" => "delAction", "confirm" => "Do you really want to delete this unit?"]) ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<div id="editDiv">
<h2>Edit unit</h2>
<?php
echo $this->Form->create($blankUnit, ["url" => "/units/edit/", "class" => "simpleForm"]);
echo $this->Form->control("name");
echo $this->Form->control("is_whole", ["label" => "Whole Numbers Only"]);
echo $this->Form->button(__("Update unit"));
echo $this->Form->button(__("Cancel"), ["id" => "cancelEdit", "type" => "button"]);
echo $this->Form->end();
?>
</div>
<div id="addDiv">
<h2>New unit</h2>
<?php
echo $this->Form->create($blankUnit, ["url" => "/units/new", "class" => "simpleForm"]);
echo $this->Form->control("name");
echo $this->Form->control("is_whole", ["label" => "Whole Numbers Only"]);
echo $this->Form->button(__("Create Unit"));
echo $this->Form->end();
?>
</div>
<?php echo $this->Html->script("/js/editFormMagic"); ?>
