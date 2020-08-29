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









<!--  TODO  -->





  	<header id="top" class="top-header">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-expand-lg" data-spy="affix" data-offset-top="400">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="/images/logo.png" alt="Logo">
                </a>
                
                <button class="navbar-toggler navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                    
                    
                    <?php 
                        //TODO
                    ?>
                    
                    
                        <li class="active"><a href="/">Strona główna</a></li>
                        <li><a href="/">Logowanie</a></li>
                        <li><a href="/">Rejestracja</a></li>
                        <li><a href="/">Donate</a></li>
                        
                        
                      
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
                            <a class="btn btn-border btn-lg btn-white" href="#">zaloguj się</a>
                            <a class="btn btn-border btn-lg btn-white" href="#">zarejestruj się</a>
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
                            <a class="btn btn-border btn-lg btn-white" href="#">zaloguj się</a>
                            <a class="btn btn-border btn-lg btn-white" href="#">zarejestruj się</a>
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
                            <a class="btn btn-border btn-lg btn-white" href="#">zaloguj się</a>
                            <a class="btn btn-border btn-lg btn-white" href="#">zarejestruj się</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Slider End -->
    </header>
    

















    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     <footer>
        <!-- Footer logo and social media button -->
        <div class="logo-social-area section-padding text-white">
            <div class="container text-center">
                <a class="logo logo-footer" href="/">
                    <img src="/images/logo.png" alt="Logo">
                </a>
                <div class="footer-contact">
                    <p class="email"><i class="fa fa-envelope-o"></i> kontakt@powiadomienia.eu</p>
                </div>
            </div>
        </div>
        <!-- Footer logo and social media button -->

        <!-- Footer copyrgiht and navigation -->
        <div class="copyright-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <p class="copyright">Copyright &copy; <?= (date('Y', time())) ?>. Wszelkie prawa zastrzeżone</p>
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
