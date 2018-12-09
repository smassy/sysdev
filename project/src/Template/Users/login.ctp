<h1>Login</h1>
<?php
echo $this->Form->create();
echo $this->Form->Control("name");
echo $this->Form->Control("password");
echo $this->Form->button("Login");
echo $this->Form->end();
?>
