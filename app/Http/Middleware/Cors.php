<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    
    public function handle(Request $request, Closure $next)
    {
        return $next($request)->header('Access-Control-Allow-Origin', "*")
                                ->header('Access-Control-Allow-Method', "Get, Post, Put")
                                ->header('Access-Control-Allow-Headers', "content-type, Authorization");
                                
    }
}
