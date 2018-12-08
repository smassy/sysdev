<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
<h2>Item Details</h2>
<ul id="itemActions">
<li class="itemAction" id="deleteItem"><?= $this->Form->postLink("Delete", ["action" => "delete", $item->id], 
["role" => "item", "class" => "fa fa-trash","confirm" => "Are you sure you want to delete this item (" . $item->name . ")? this cannot be undone!"]) ?></li>
<li class="itemAction" id="editItem"><i class="fa fa-edit"><?= $this->Html->link("Edit", ["role" => "item","action" => "edit", $item->id]) ?></i></li>

</ul>
<div id="itemDetails">
<table>
<tr>
<td class="itemLabel">Name</td>
<td class="itemDetail">
<?= $item->name ?>
</td>
</tr>
<tr>
<td class="itemLabel">Category</td>
<td class="itemDetail">
<?= $item->category->name ?>
</td>
</tr>
<tr>
<td class="itemLabel">Supplied by</td>
<td class="itemDetail">
<?= $item->supplier->name ?>
</td>
</tr>
<tr>
<td class="itemLabel">Measured in</td>
<td class="itemDetail">
<?= $item->unit->name ?>
</td>
</tr>
<tr>
<td class="itemLabel">Current quantity</td>
<td class="itemDetail">
<?= $item->qty ?>
</td>
</tr>
<tr>
<td class="itemLabel">Low stock threshold</td>
<td class="itemDetail">
<?= $item->threshold ?>
</td>
</tr>
<tr>
<td class="itemLabel">Last arrival on</td>
<td class="itemDetail">
<?= $item->last_added->format("F j, Y") ?>
&nbsp;
<?php
echo "(";
$delta = $item->getDaysSinceArrived();
switch($delta) {
case 0: echo "Today";
	break;
case 1: echo "Yesterday";
	break;
default: echo $delta . " days ago";
}
echo ")";
?>
</td>
</tr>
</table>
</div>
