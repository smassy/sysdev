<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
<?= $this->Html->link('Categories', ['action' => 'edit',$post->id]);?>
 */
 

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->script("jquery-3.3.1.min");?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
	<header>
      <h1 class="header_image">
  			<img class ="h-logo" <?= $this->Html->image('logo.jpg')?> 
      </h1>
	</header>
    <nav class="top-bar expanded" data-topbar role="navigation" >
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="left">
                <li><?= $this->Form->button(__("Add Item"), ["type" => "button", "id" => "addItemBtn", "onclick" => "window.location='/items/new'"]) ?></li>
		<li><button onclick="window.open('/items/list/print')" id="printBtn">Print</button></li>
		<li><button onclick="window.location='/users/logout'" id="logoutBtn">Log Out</button></li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
		Vaï Burger &#9856; 
		1550 Boulevard Cote-Vertu Ouest &#9856;
		Saint-Laurent, QC H4L 1Z8 &#9856;
		(514) 334-4443
    </footer>
</body>
</html>
