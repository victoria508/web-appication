<?php

namespace Brainr\Http\Middleware;

use Closure;
use Session;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $local = $_GET['lang'] ?? Session::get('language', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        app()->setLocale($local);
        Session::put('language', $local);
        return $next($request);
    }

}
