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
          'name' => 'Super Company',
      ]);
    }
}
