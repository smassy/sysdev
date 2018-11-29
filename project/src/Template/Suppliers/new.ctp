<h1>New Supplier</h1>
<?php
echo $this->Form->create($newSupplier);
echo $this->Form->control("name");
echo $this->Form->button(__("Create"));
echo $this->Form->end();
?>

