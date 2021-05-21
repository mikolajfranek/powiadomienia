<?php
$url = "https://powiadomienia.eu/notifications/send";
$options = array(
	"http" => array(
		"header"  => "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:81.0) Gecko/20100101 Firefox/81.0",
		"method"  => "GET"
	)
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
file_put_contents('/home/powiadg/cron/logs.txt', $result.PHP_EOL, FILE_APPEND | LOCK_EX);
