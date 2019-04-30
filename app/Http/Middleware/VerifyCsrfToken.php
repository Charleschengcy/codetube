<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Closure;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/videos',
        'video_update'
    ];

    public function handle($request, Closure $next)
    {
        // 如果是来自 api 域名，就跳过检查
        if ($_SERVER['SERVER_NAME'] != config('api.domain'))
        {
            return parent::handle($request, $next);
        }

        return $next($request);
    }
}
