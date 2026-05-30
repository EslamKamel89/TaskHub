<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class InitializeTenancyByCookie {
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        // the dump i used below is for debugging and later will be removed naturally after i am sure that every thing is working fine
        $publicId = $request->cookie('tenant');
        dump(DB::connection()->getDatabaseName());
        dump($publicId);
        $tenant = Tenant::where('public_id', $publicId)->first();
        dump($tenant);
        if ($tenant) {
            tenancy()->initialize($tenant);
        }
        dump(DB::connection()->getDatabaseName());
        return $next($request);
    }
}
