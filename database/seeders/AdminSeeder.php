<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin =Admin::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'name'     => 'Administrator',
        ]);
        $admin->assignRole(Role::where('name','Super-Admin')->first());
    }
}
