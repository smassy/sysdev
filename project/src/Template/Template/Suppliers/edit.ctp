<h1>Update Supplier</h1>
<?php
echo $this->Form->create($supplier);
echo $this->Form->control("name");
echo $this->Form->button(__("Save"));
echo $this->Form->end();
?>
