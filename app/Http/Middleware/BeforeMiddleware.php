<?php

namespace App\Http\Middleware;

use App\Http\Models\GlobalSettings;
use Closure;
use Auth;
use Illuminate\Support\Facades\Session;


class BeforeMiddleware
{
    public function handle($request, Closure $next)
    {
            // Perform action
        $settings = GlobalSettings::getSettings('global_open_close');
        $settings = json_decode($settings->value);
        if($settings->status){
            return $next($request);
        } else if(! $settings->status){
            $path = $request->path();
            if($path == 'auth/login' || $path == 'web88cms/login' || $path == 'web88cms/logout'){

                return $next($request);
            } else{
                if($settings->who == 1){
                    if(Session::get('can_navigate')){
                        return $next($request);
                    } else{
                        Session::set('can_navigate', true);
                    }
                    return redirect('coming_soon')->with('can_close', true);
                } elseif($settings->who == 2 ){
                    if(isset(Auth::user()->isSuperAdmin)){
                        return $next($request);
                    } else{
                        return redirect('coming_soon')->with('can_close', false);
                    }
                } elseif( $settings->who == 3 ){
                    if(isset(Auth::user()->id) && $settings->user_id == Auth::user()->id){
                        return $next($request);
                    } else{
                        return redirect('coming_soon')->with('can_close', false);
                    }
                } else{
                    dd('else');
                    //return redirect('coming_soon')->with('can_close', true);
                }
            }
        }

        return $next($request);
    }
}