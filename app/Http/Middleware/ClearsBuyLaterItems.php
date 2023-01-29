<?php

namespace App\Http\Middleware;

use App\Actions\ClearBuyLaterItems;
use Closure;
use Illuminate\Http\Request;

class ClearsBuyLaterItems
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
		(new ClearBuyLaterItems())();

        return $next($request);
    }
}
