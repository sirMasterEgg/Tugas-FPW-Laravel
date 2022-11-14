<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Store;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
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
        $user = Session::get('active');
        if (!$user) {
            return redirect()->route('login');
        }

        if ($user != 'admin') {
            $res = Customer::where('username', $user)->first();
            if ($res) {
                return redirect()->route('customer-index');
            }

            $resToko = Store::where('username', $user)->first();
            if ($resToko) {
                return redirect()->route('toko-index');
            }
        }

        return $next($request);
    }
}
