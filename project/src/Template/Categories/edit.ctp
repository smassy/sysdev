<h1>Update Category</h1>
<?php
echo $this->Form->create($category);
echo $this->Form->control("name");
echo $this->Form->button(__("Save"));
echo $this->Form->end();
?>
