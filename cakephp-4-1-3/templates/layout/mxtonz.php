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
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;

?>
<!DOCTYPE html>
<html>
<head> 
    <!-- Site information -->
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Configure::read('Config.WebName') ?></title>
    <meta name="description" content="Serwis powiadomień e-mail o wynikach gier hazardowych, takich jak Lotto, Lotto Plus, Mini Lotto">

    <!-- External CSS -->
    <?= $this->Html->css (['/assets/css/bootstrap.min.css', '/assets/css/font-awesome.min.css', '/assets/css/owl.carousel.css', '/assets/css/owl.transitions.css', '/assets/css/magnific-popup.css', '/assets/css/apps.css', '/assets/css/plyr.css' ]) ?>
    
    <!-- CSS -->
    <?= $this->Html->css(['style', 'responsive']) ?>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    
    <!-- Favicon -->
	<?= $this->Html->meta('icon') ?>
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
  	<header id="top" class="top-header">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-expand-lg" data-spy="affix" data-offset-top="400">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">     	
                 	<img src="/images/logo.png" alt="Logo" >
                	<span class="h5 text-bg">Powiadomienia</span>
                </a>
                <button class="navbar-toggler navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <?php
                            foreach($navigationBar as $action){   
                                echo "<li class='" . ($action['isActive'] ? 'active' : '') ."'>"
                                    .
                                    $this->Html->link($action['name'],$action['href'])
                                    .
                                "</li>";
                            }                        
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navigation End -->
    </header>
  
    <div class="main-wrap">
        <div class="section-padding bottom-0 theme-bg">
         	<div class="container">
         		<?= $this->Flash->render() ?>
            </div>            
    	</div>
        <?= $this->fetch('content') ?>
    </div>
 
    <!-- Script -->    
    <?= $this->Html->script(['/assets/js/jquery.min.js', '/assets/js/bootstrap.min.js', '/assets/js/owl.carousel.js', '/assets/js/imagesloaded.pkgd.min.js', '/assets/js/jquery.magnific-popup.min.js', '/assets/js/plyr.js', '/assets/js/jquery.ajaxchimp.min.js', '/assets/js/isotope.pkgd.min.js', '/assets/js/jquery.countdown.min.js', '/assets/js/tether.min.js', '/assets/js/jquery.slimscroll.min.js', '/assets/js/amplitude.js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAmiJjq5DIg_K9fv6RE72OY__p9jz0YTMI', '/js/map.js', '/js/custom.js']) ?>
	<?= $this->fetch('script') ?>
</body>
</html>
