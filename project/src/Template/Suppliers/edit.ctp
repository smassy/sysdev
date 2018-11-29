<h1>Update Suppliger</h1>
<?php
echo $this->Form->create($suppliger);
echo $this->Form->control("name");
echo $this->Form->button(__("Save"));
echo $this->Form->end();
?>
