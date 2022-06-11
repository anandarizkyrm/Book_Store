<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if($request->user()->role=='su'){
            return $next($request);
        }
        else{
            request()->session()->flash('error','You do not have any permission to access this page');
            return redirect()->route('admin');
        }
    }
}
