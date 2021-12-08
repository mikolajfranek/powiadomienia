<?php
$url = "https://powiadomienia.eu/notifications/send";
$options = array(
	"http" => array(
		"header" => "User-Agent: Automat\r\nContent-Length: 0\r\n",
		"method"  => "POST"
	)
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
file_put_contents('/home/powiadg/cron/logs.txt', $result.PHP_EOL, FILE_APPEND | LOCK_EX);
