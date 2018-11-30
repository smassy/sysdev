<h1>New Unit</h1>
<?php
echo $this->Form->create($newUnit);
echo $this->Form->control("name");
echo $this->Form->control("is_whole", ["label" => "Whole Numbers Only"]);
echo $this->Form->button(__("Create"));
echo $this->Form->end();
?>

