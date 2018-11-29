<h1>New Suppliger</h1>
<?php
echo $this->Form->create($newSuppliger);
echo $this->Form->control("name");
echo $this->Form->button(__("Create"));
echo $this->Form->end();
?>

