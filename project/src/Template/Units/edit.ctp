<h1>Update Units</h1>
<?php
echo $this->Form->create($unit);
echo $this->Form->control("name");
echo $this->Form->control("is_whole", ["label" => "Whole Numbers Only"]);
echo $this->Form->button(__("Save"));
echo $this->Form->end();
?>
