<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Roles
        $studentRole = Role::create(['name' => 'student']);
        $parentRole = Role::create(['name' => 'parent']);
        $teacherRole = Role::create(['name' => 'teacher']);

        // Create Permissions
        Permission::create(['name' => 'view grades']);
        Permission::create(['name' => 'view students']);
        Permission::create(['name' => 'view homework']);
        Permission::create(['name' => 'manage homework']);
        Permission::create(['name' => 'manage students']);
        Permission::create(['name' => 'create lesson']);
        Permission::create(['name' => 'manage lessons']);

        // Assign Permissions to Roles
        $studentRole->givePermissionTo('view grades');
        $studentRole->givePermissionTo('view homework');

        $parentRole->givePermissionTo('view grades');

        $teacherRole->givePermissionTo('view homework');
        $teacherRole->givePermissionTo('manage homework');
        $teacherRole->givePermissionTo('manage students');
        $teacherRole->givePermissionTo('create lesson');
        $teacherRole->givePermissionTo('manage lessons');
    }
}
