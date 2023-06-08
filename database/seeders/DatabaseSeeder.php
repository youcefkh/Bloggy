<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $this->call([
           PermissionSeeder::class,
           RolesSeeder::class,
           AdminSeeder::class
        ]);
        // create permissions




        // create roles and assign existing permissions

        // \App\Models\User::factory(10)->create();
    }
}
