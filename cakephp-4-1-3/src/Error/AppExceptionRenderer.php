<?php

namespace App\Error;

use Cake\Core\Exception\Exception;
use Cake\Error\ExceptionRenderer;
use Cake\Log\Log;

class AppExceptionRenderer extends ExceptionRenderer
{
    public function getClientIp() {
        $ip = 'UNKNOWN';
        if (getenv('HTTP_CLIENT_IP')){
            $ip = getenv('HTTP_CLIENT_IP');
        }else if(getenv('HTTP_X_FORWARDED_FOR')){
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        }else if(getenv('HTTP_X_FORWARDED')){
            $ip = getenv('HTTP_X_FORWARDED');
        }else if(getenv('HTTP_FORWARDED_FOR')){
            $ip = getenv('HTTP_FORWARDED_FOR');
        }else if(getenv('HTTP_FORWARDED')){
            $ip = getenv('HTTP_FORWARDED');
        }else if(getenv('REMOTE_ADDR')){
            $ip = getenv('REMOTE_ADDR');
        }
        return $ip;
    }
    
    public function __construct(Exception $e) {
        Log::write('error', $this->getClientIp());
        Log::write('error', $e->getMessage());
        Log::write('error', $e->getTraceAsString());
        ob_start();
        echo "Krytyczny błąd";
        ob_end_flush();
        exit;
    }
}