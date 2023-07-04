<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Intranet\Shops\ShopSession;
use Closure;

class AuthIntranet
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth('intranet')->check()) {
            return redirect()->route('intranet.shops.index', ['prueba']);
        }
        return redirect()->route('intranet.auth.show');

    }
}
