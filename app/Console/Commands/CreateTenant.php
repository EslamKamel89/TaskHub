<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

#[Signature('tenants:create')]
#[Description('Create a new tenant')]
class CreateTenant extends Command {
    /**
     * Execute the console command.
     */
    public function handle() {
        $name = trim($this->ask('Tenant name'));
        if ($name === '') {
            $this->error('Tenant name is required.');
            return self::FAILURE;
        }
        $slug = Str::slug($name, '_');
        $publicId = "ten_{$slug}";
        $database = "tenant_{$slug}";
        if (Tenant::where('public_id', $publicId)->exists()) {
            $this->error("Tenant [{$publicId}] already exists.");
            return self::FAILURE;
        }
        $tenant = Tenant::create([
            'database' => $database,
            'public_id' => $publicId,
            'name'  => $name,
        ]);
        $this->info("Tenant Created: {$tenant->public_id}");
        return self::SUCCESS;
    }
}
