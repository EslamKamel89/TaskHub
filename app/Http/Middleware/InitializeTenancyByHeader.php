<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InitializeTenancyByHeader {
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $publicId = $request->header('X-Tenant');
        // info(DB::connection()->getDatabaseName());
        // info($publicId);
        $tenant = Tenant::where('public_id', $publicId)->first();
        // info($tenant);
        if ($tenant) {
            tenancy()->initialize($tenant);
        }
        // info(DB::connection()->getDatabaseName());
        return $next($request);
    }
}
