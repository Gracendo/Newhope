<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Lang;

class adminGlobalVar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = !empty(session()->get('lang')) ? session()->get('lang') : Lang::where('default',1)->first()->slug;
        $all_languages = Lang::all();

        $admin_languages = Lang::where(['default'=>1,'status'=>'publish'])->first();
        $admin_default_lang = $admin_languages->slug;

        $data = [
            'lang' => $lang,
            'all_languages' => $all_languages,
        ];

        view()->composer('*', function ($view) use ($data) {
            $view->with($data);
        });

        return $next($request);
    }
}
