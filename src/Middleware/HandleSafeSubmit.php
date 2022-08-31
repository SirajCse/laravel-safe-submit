<?php

namespace SirajCSE\LaravelSafeSubmit\Middleware;

use Closure;
use Illuminate\Http\Request;
use SirajCSE\LaravelSafeSubmit\SafeSubmit;

class HandleSafeSubmit
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
        
        if ($request->{$safeSubmit->tokenKey()} !== $safeSubmit->token()) {
            if ($intended = $safeSubmit->getIntended()) {
                $safeSubmit->forgetIntended();

                return redirect($intended);
            }

            abort(419);
        }

        $safeSubmit->regenerateToken();

        return $next($request);
    }
}
