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

$notification = $this->Flash->render("notification");
$notification = str_replace(' onclick="this.classList.add(' . "'hidden'" . ');"', '', $notification);
$notify = false;
if(empty($notification) == false)
{
    $notify = true;
}
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
<body class="<?= $bodyClass ?>">
    <nav>
        <!-- BEGIN: Notification Content -->
        <div id="basic-non-sticky-notification-content" class="toastify-content hidden flex flex-col sm:flex-row">
            <div class="font-medium"><?= $notification ?></div> 
        </div>
        <!-- END: Notification Content -->
        <!-- BEGIN: Notification Toggle -->
        <button id="basic-sticky-notification-toggle" class="hidden"></button>          
        <!-- END: Notification Toggle -->
    </nav>
    <main>
		<?= $this->fetch('content') ?>
	</main>
    <footer>
        <!-- BEGIN: JS Assets-->
        <script type="text/javascript" src="/dist/js/app.js"></script>
        <!-- END: JS Assets-->
    	<script type="text/javascript">
    		var notify = <?php echo $notify; ?>;
            $(document).ready(function() 
            {
            	if(notify)
        		{	
        			$("#basic-sticky-notification-toggle").trigger("click");	
        		}		
            });
    	</script>
    </footer>
</body>
</html>
