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

        Permission::create(['name' => 'manage-posts']);
        Permission::create(['name' => 'manage-comments']);
        Permission::create(['name' => 'write-comments']);

        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);

        $adminRole->givePermissionTo([
            'manage-posts',
            'manage-comments',
            'write-comments'
        ]);

        $userRole->givePermissionTo([
            'write-comments'
        ]);
    }
}
