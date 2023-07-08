<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::truncate();
        Role::truncate();

        Permission::create(['name' => 'manage-own-lists']);
        Permission::create(['name' => 'view-lists-of-others']);

        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);

        $adminRole->givePermissionTo([
            'manage-own-lists',
            'view-lists-of-others',
        ]);

        $userRole->givePermissionTo([
            'manage-own-lists'
        ]);
    }
}
