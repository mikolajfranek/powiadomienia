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
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?= Configure::read('Config.WebName') ?></title>
    <link href="/dist/images/logo.svg" rel="shortcut icon"/>
    <?= $this->Html->meta('icon') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet"/>
	<?= $this->Html->css(['app.css', 'my.css']) ?>
    <?= $this->Html->script(['jquery-3.6.0.min']) ?>
</head>
<body class="main">
    <nav>
    </nav>
    <main>
		<!-- BEGIN: Error Page -->
        <div class="error-page flex flex-col lg:flex-row items-center justify-center h-screen text-center lg:text-left">
            <div class="-intro-x lg:mr-20">
                <img alt="Rubick Tailwind HTML Admin Template" class="h-48 lg:h-auto" src="/dist/images/error-illustration.svg">
            </div>
            <div class="text-white mt-10 lg:mt-0">
                <div class="intro-x text-4xl font-medium">:(</div>
                <div class="intro-x text-xl lg:text-3xl font-medium mt-5">Oops. Strona zniknęła.</div>
                <div class="intro-x text-lg mt-3">Być może błędnie wpisałeś adres lub strona mogła zostać przeniesiona.</div>
                <?php 
                echo $this->Html->link('Strona główna',
                    array("controller" => "users", "action" => "login"),
                    array("escape" => false, "class" => "intro-x btn py-3 px-4 text-white border-white dark:border-dark-5 dark:text-gray-300 mt-10"));
                ?>
            </div>
        </div>
        <!-- END: Error Page -->
	</main>
    <footer>
        <!-- BEGIN: JS Assets-->
        <script type="text/javascript" src="/dist/js/app.js"></script>
        <!-- END: JS Assets-->
    </footer>
</body>
</html>
