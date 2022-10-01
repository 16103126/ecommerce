<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(\Request::is('admin') || \Request::is('admin/*'))
            {
                $data = DB::table('admin_languages')->where('is_default', 1)->first();
                if($data){

                    App::setLocale($data->name);
                }
            }else{
                if(Session::has('language'))
                {
                    $data = DB::table('frontend_languages')->find(Session::get('language'));
                    
                    App::setLocale($data->name);
                }else{
                    $data = DB::table('frontend_languages')->where('is_default', 1)->first();
                    App::setLocale($data->name);
                }
            } 

        return $next($request);
    }
}
