<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<h1>Manage Categories</h1>
<h2>Current Categories</h2>
<table class="manageSecondary" id="categoriesTable">
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
<button class="editAction" id="edit-<?php echo urlencode(str_replace("-", "__", $category->name)) . "-" . $category->id?>"><i class="fa fa-edit"></i></button>
</td>
<td>
<?php echo $category->count > 0 ? "<button class=\"noDelete\" onclick=\"alert('All associations must be removed before a category can be deleted.')\"><i class=\"fa fa-info-circle\"></i></button>" :
 $this->Form->postLink("", ["action" => "delete", $category->id], ["role" => "item", "class" => "fa fa-trash","style" =>"font-size:25px; padding-left: 100px;padding-top: 10px;", "confirm" => "Do you really want to delete this category?"]) ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<div id="editDiv">
<h2>Edit Category</h2>
<?php
echo $this->Form->create($blankCategory, ["url" => "/categories/edit/", "class" => "simpleForm"]);
echo $this->Form->control("name");
echo $this->Form->button(__("Update Category"), ["id" => "updateCat"]);
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
