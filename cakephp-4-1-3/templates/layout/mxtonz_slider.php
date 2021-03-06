<?php

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
    <meta name="description" content="Serwis umożliwiający otrzymywanie powiadomienia email zawierające porównanie wyników losowania gier hazardowych (takich jak Lotto, Lotto Plus, Mini Lotto) z zadreklarowanymi zakładami użytkownika.">

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
                	<span class="h5">Powiadomienia</span>
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

        <!-- Banner Slider -->
        <div class="banner-slider owl-slider" id="banner-slider">
            <div class="banner-item banner-item-1 text-center">
                <div class="banner-content text-white">
                    <div class="container">
                        <h3 class="banner-subtitle theme-color">powiadomienia.eu</h3>
                        <h1 class="banner-title">zarejestruj kupony</h1>
                        <div class="button-group">
                            <?php 
                                echo $this->Html->link('rejestracja do serwisu', array('controller' => 'users', 'action' => 'register'), array('class' => "btn btn-border btn-white"));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-item banner-item-2 text-center">
                <div class="banner-content text-white">
                    <div class="container">
                        <h3 class="banner-subtitle theme-color">powiadomienia.eu</h3>
                        <h1 class="banner-title">zaczekaj na email</h1>
                        <div class="button-group">
                            <?php 
                                echo $this->Html->link('rejestracja do serwisu', array('controller' => 'users', 'action' => 'register'), array('class' => "btn btn-border btn-white"));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
              <div class="banner-item banner-item-3 text-center">
                <div class="banner-content text-white">
                    <div class="container">
                        <h3 class="banner-subtitle theme-color">powiadomienia.eu</h3>
                        <h1 class="banner-title">odbierz wyganą</h1>
                        <div class="button-group">
                            <?php 
                                echo $this->Html->link('rejestracja do serwisu', array('controller' => 'users', 'action' => 'register'), array('class' => "btn btn-border btn-white"));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Slider End -->
    </header>
    
    <div class="main-wrap">
        <?= $this->fetch('content') ?>
    </div>
    
    <footer>
        <!-- Upcoming Stage -->
        <div class="section section-padding upcoming-stage-section text-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-header left-style">
                            <h3 class="section-title">już teraz<br/>bądź powiadomiony</h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stage-countdown-wrap">
                            <div class="section-header">
                                <h3 class="stage-title">Kontakt</h3><br/>
                                <p class="stage-location email"><i class="fa fa-envelope-o"></i> <?= Configure::read('Config.Email.web') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Upcoming Stage End -->
        
        <!-- Footer copyrgiht and navigation -->
        <div class="copyright-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <p class="copyright">Copyright &copy; <?= (date('Y', time())) > 2020 ? "2020-" . (date('Y', time())) : 2020  ?>. Wszelkie prawa zastrzeżone.</p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p class="credit-text"><a href="/"><?= Configure::read('Config.WebName') ?></a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer copyrgiht and navigation -->
    </footer>
    
    <!-- Script -->    
    <?= $this->Html->script(['/assets/js/jquery.min.js', '/assets/js/bootstrap.min.js', '/assets/js/owl.carousel.js', '/assets/js/imagesloaded.pkgd.min.js', '/assets/js/jquery.magnific-popup.min.js', '/assets/js/plyr.js', '/assets/js/jquery.ajaxchimp.min.js', '/assets/js/isotope.pkgd.min.js', '/assets/js/jquery.countdown.min.js', '/assets/js/tether.min.js', '/assets/js/jquery.slimscroll.min.js', '/assets/js/amplitude.js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAmiJjq5DIg_K9fv6RE72OY__p9jz0YTMI', '/js/map.js', '/js/custom.js']) ?>
	<?= $this->fetch('script') ?>
</body>
</html>
