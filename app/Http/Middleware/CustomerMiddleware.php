<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Log;
use App\Models\Store;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerMiddleware
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

        $res = Customer::where('username', $user)->first();
        if (!$res) {
            $resToko = Store::where('username', $user)->first();
            if ($resToko) {
                return redirect()->route('toko-index');
            }

            if ($user == 'admin') {
                return redirect()->route('admin-index');
            }
        }

        $response = $next($request);

        Log::create([
            'log_username' => $user,
            'log_path' => $request->url(),
            'log_statuscode' => $response->status(),
            'log_ip' => $request->ip(),
            'log_time' => now(),
        ]);

        return $response;
    }
}
