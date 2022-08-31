<?php

namespace SirajCSE\LaravelSafeSubmit\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SirajCSE\LaravelSafeSubmit\SafeSubmit;

class GenerateSafeSubmitToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $safeSubmit = app(SafeSubmit::class);

        if ($this->isReading($request)) {
            $safeSubmit->regenerateToken();
        }

        return $next($request);
    }

    protected function isReading($request)
    {
        return in_array($request->method(), ['HEAD', 'GET', 'OPTIONS']);
    }
}
