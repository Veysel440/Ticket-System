<?php

namespace App\Exceptions;

use PHPUnit\Event\Code\Throwable;

class Handler
{
    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            $code = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
            return response()->json([
                'success' => false,
                'error' => [
                    'message' => $exception->getMessage(),
                    'type'    => class_basename($exception),
                    'code'    => $code,
                ]
            ], $code);
        }
        return parent::render($request, $exception);
    }

}
