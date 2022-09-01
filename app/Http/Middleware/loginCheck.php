<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class loginCheck
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
        // dd($request->all());
        // if ($request->id <= 0) {
        //     return redirect('forum');
        // }
        // if (! $request->expectsJson()) {
            // return route('login');
        // // return response()->json($request);
        // }
        return $next($request);
    }
}
