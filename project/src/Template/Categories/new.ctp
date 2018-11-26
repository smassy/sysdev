<h1>New Category</h1>
<?php
echo $this->Form->create($newCategory);
echo $this->Form->control("name");
echo $this->Form->button(__("Create"));
echo $this->Form->end();
?>

