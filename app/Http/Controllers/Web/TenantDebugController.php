<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TenantDebugController extends Controller {
    public function debugTenant(Request $request, string $publicId) {
        $tenant = Tenant::where('public_id', $publicId)->firstOrFail();
        dump(DB::connection()->getDatabaseName());
        tenancy()->initialize($tenant);
        dump('After initialization: ');
        dump(DB::connection()->getDatabaseName());
        dump('Current Tenant: ');
        dump($tenant);
        return 'done';
    }
    public function checkTenant(Request $request) {
        return response()->json([
            'tenant' => tenant()?->public_id,
            'database' => DB::connection()->getDatabaseName(),
        ]);
    }
}
