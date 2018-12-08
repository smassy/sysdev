<?php
/**
 * This is a skinned down version of default.ctp which just a close button.
 * This will be used for pop up windows to manage Categories, Suppliers and
 * Units.
 * 
 * ID: closeButton (the close button for any window view.)
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
         <!--<img src="logo.jpg"  alt="" title="Vai Burger" />--> 
			<img class ="h-logo" <?= $this->Html->image('logo.jpg')?> 
      </h1>
   </header>
   
    <nav class="top-bar expanded" data-topbar role="navigation" id="defaultNav">
        <div class="top-bar-section" id="sectionRight">
            <ul class="right">
                <li><button onclick="window.close()" id="closeBtn">Close</button></li>
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
