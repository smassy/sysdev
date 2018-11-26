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
Placeholder
</td>
<td>
Placeholder
</td>
</tr>
<?php endforeach; ?>
</table>

<h2>New Category</h2>
<?php
echo $this->Form->create($blankCategory, ["url" => "/categories/new"]);
echo $this->Form->control("name");
echo $this->Form->button(__("Create Category"));
echo $this->Form->end();
?>
