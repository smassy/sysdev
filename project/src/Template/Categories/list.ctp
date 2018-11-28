<h1>Manage Categories</h1>
<h2>Current Categories</h2>
<table>
<thead>
<tr>
<th>Name</th>
<th>Associations</th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<?php foreach ($categories as $category): ?>
<tr>
<td>
<?php echo $category->name ?>
</td>
<td>
<?php echo $category->count ?>
</td>
<td>
<button class="actionButton" id="edit-<?php echo urlencode(str_replace("-", "__", $category->name)) . "-" . $category->id?>">Edit</button>
</td>
<td>
<button class="actionButton" id="delete-<?php echo $category->name . "-" . $category->id?>" <?php echo $category->count > 0 ? "disabled" : "" ?>>Delete</button>
</td>
</tr>
<?php endforeach; ?>
</table>
<div id="editDiv">
<h2>Edit Category</h2>
<?php
echo $this->Form->create($blankCategory, ["url" => "/categories/edit/", "class" => "simpleForm"]);
echo $this->Form->control("name");
echo $this->Form->button(__("Update Category"));
echo $this->Form->button(__("Cancel"), ["id" => "cancelEdit", "type" => "button"]);
echo $this->Form->end();
?>
</div>
<div id="addDiv">
<h2>New Category</h2>
<?php
echo $this->Form->create($blankCategory, ["url" => "/categories/new", "class" => "simpleForm"]);
echo $this->Form->control("name");
echo $this->Form->button(__("Create Category"));
echo $this->Form->end();
?>
</div>
<?php echo $this->Html->script("/js/editFormMagic"); ?>