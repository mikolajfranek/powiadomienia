<?php 
ob_start();
header('Location: https://powiadomienia.eu/notification/send', true, 301);
ob_end_flush();
exit;
