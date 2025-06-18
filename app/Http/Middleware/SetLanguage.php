<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use App\Models\Lang;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$location): Response
    {
        if (session()->has('lang')) {
            
            Carbon::setLocale(session()->get('lang'));
            app()->setLocale(session()->get('lang').'_'.$location);
        } else {
            $defaultLang =  Lang::where('default',1)->first();
            if (!empty($defaultLang)) {
				Carbon::setLocale($defaultLang->slug);
                app()->setLocale($defaultLang->slug.'_'.$location);
            }
        }

        return $next($request);
    }
}