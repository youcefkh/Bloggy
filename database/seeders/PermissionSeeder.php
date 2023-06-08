<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['guard_name' => 'admin', 'name' => 'show articles']);
        Permission::create(['guard_name' => 'admin', 'name' => 'show categories']);
        Permission::create(['guard_name' => 'admin', 'name' => 'show subcategories']);
        Permission::create(['guard_name' => 'admin', 'name' => 'show settings']);
        Permission::create(['guard_name' => 'admin', 'name' => 'show admins']);
        Permission::create(['guard_name' => 'admin', 'name' => 'add articles']);
        Permission::create(['guard_name' => 'admin', 'name' => 'add categories']);
        Permission::create(['guard_name' => 'admin', 'name' => 'add subcategories']);
        Permission::create(['guard_name' => 'admin', 'name' => 'add settings']);
        Permission::create(['guard_name' => 'admin', 'name' => 'add admins']);
        Permission::create(['guard_name' => 'admin', 'name' => 'edit articles']);
        Permission::create(['guard_name' => 'admin', 'name' => 'edit categories']);
        Permission::create(['guard_name' => 'admin', 'name' => 'edit subcategories']);
        Permission::create(['guard_name' => 'admin', 'name' => 'edit settings']);
        Permission::create(['guard_name' => 'admin', 'name' => 'edit admins']);
        Permission::create(['guard_name' => 'admin', 'name' => 'delete articles']);
        Permission::create(['guard_name' => 'admin', 'name' => 'delete categories']);
        Permission::create(['guard_name' => 'admin', 'name' => 'delete subcategories']);
        Permission::create(['guard_name' => 'admin', 'name' => 'delete settings']);
        Permission::create(['guard_name' => 'admin', 'name' => 'delete admins']);
        Permission::create(['guard_name' => 'admin', 'name' => 'publish articles']);
        Permission::create(['guard_name' => 'admin', 'name' => 'unpublish articles']);

    }
}
