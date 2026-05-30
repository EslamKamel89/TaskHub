<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TenantDebugController extends Controller {

    public function checkTenant(Request $request) {
        return response()->json([
            'tenant' => tenant()?->public_id,
            'database' => DB::connection()->getDatabaseName(),
        ]);
    }
}
