<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call([
          SuperAdminSeeder::class,
      ]);
        // \App\Models\User::factory(10)->create();
        // $tenant_id = Str::uuid();
        //
        // \App\Models\User::factory()->create([
        //     'name' => 'Super Admin',
        //     'email' => 'superadmin@mycompany.com',
        //     'username' => 'superadmin',
        //     'password' => Hash::make('secret'),
        //     'tenant_id' => $tenant_id;
        // ]);


    }
}
