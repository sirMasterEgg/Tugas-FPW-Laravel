<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Store;
use Illuminate\Http\Request;

class isBlocked
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
        $storeid = $request->route()->parameter('id');

        $store = Store::withTrashed()->where('username', $storeid)->first();

        if ($store->trashed()) {
            return redirect()->route('customer-index')->with('error', 'Toko ini telah diblokir');
        }

        return $next($request);
    }
}
