<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        // ... middleware lainnya ...
        'validate.token' => \App\Http\Middleware\ValidateToken::class,
    ];

    /**
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        // ...
        'validate.token' => \App\Http\Middleware\ValidateToken::class,
    ];
} 