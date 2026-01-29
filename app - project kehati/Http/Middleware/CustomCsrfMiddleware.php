<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class CustomCsrfMiddleware extends Middleware
{
    /**
     * URL yang tidak butuh verifikasi CSRF.
     *
     * @var array<int, string>
     */
    protected $except = [
        
    ];
}
