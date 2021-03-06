<?php

namespace App\Error;

use Cake\Error\ExceptionRenderer;
use Cake\Http\ServerRequest;
use Cake\Log\Log;
use Throwable;

class AppExceptionRenderer extends ExceptionRenderer
{
    public function __construct(Throwable $e, ?ServerRequest $request = null)
    {
        Log::write('error', isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "");
        Log::write('error', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "");
        Log::write('error', $e->getMessage());
        Log::write('error', $e->getTraceAsString());
        ob_clean();
        ob_start();
        echo "Krytyczny błąd";
        ob_end_flush();
        exit;
    }
}