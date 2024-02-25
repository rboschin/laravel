<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $tenant_id = Str::uuid();
      \App\Models\User::factory()->create([
        'name' => 'Super Admin',
        'email' => 'superadmin@mycompany.com',
        'username' => 'superadmin',
        'password' => \Hash::make('superadmin'),
        'tenant_id' => $tenant_id,
      ]);
      \App\Models\Tenant::factory()->create([
        'id' => $tenant_id,
        'name' => 'Super Administration',
        'code' => 'superadmin',
      ]);

        $tenant_id = Str::uuid();
        \App\Models\User::factory()->create([
          'name' => 'Super Admin Stancl',
          'email' => 'stancl@mycompany.com',
          'username' => 'superstancl',
          'password' => \Hash::make('superstancl'),
          'tenant_id' => $tenant_id,
        ]);
        \App\Models\Tenant::factory()->create([
          'id' => $tenant_id,
          'name' => 'Super Stancl',
          'code' => 'stancl',
          'method' => 'subdomain',
          'method_value' => 'stancl'
        ]);

        $tenant_id = Str::uuid();
        \App\Models\User::factory()->create([
          'name' => 'Super Admin Laravel',
          'email' => 'laravel@mycompany.com',
          'username' => 'superlaravel',
          'password' => \Hash::make('laravel'),
          'tenant_id' => $tenant_id,
        ]);
        \App\Models\Tenant::factory()->create([
          'id' => $tenant_id,
          'name' => 'Super Laravel',
          'code' => 'laravel',
          'method' => 'domain',
          'method_value' => 'laravel.ok40.it'
        ]);
    }
}
