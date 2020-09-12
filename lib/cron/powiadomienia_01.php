<?php
$url = "https://powiadomienia.eu/notifications/send";
$options = array(
	"http" => array(
		"header"  => "User-Agent: mfranek",
		"method"  => "GET"
	)
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
var_dump($result);

