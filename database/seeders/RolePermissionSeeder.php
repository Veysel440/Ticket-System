<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $agent = Role::create(['name' => 'agent']);
        $customer = Role::create(['name' => 'customer']);

        Permission::create(['name' => 'manage tickets']);
        Permission::create(['name' => 'manage knowledge base']);
        Permission::create(['name' => 'view reports']);

        $admin->givePermissionTo(Permission::all());
        $agent->givePermissionTo(['manage tickets', 'manage knowledge base']);
        $customer->givePermissionTo([]);
    }
}
