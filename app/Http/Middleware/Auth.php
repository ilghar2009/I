<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()?->user();

        if(isset($user))
            return $next($request);

        return redirect()->route('authP', ['alertL' => 'Please login first']);
//        dd(auth()->user());
    }
}
