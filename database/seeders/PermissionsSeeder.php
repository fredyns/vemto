<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list records']);
        Permission::create(['name' => 'view records']);
        Permission::create(['name' => 'create records']);
        Permission::create(['name' => 'update records']);
        Permission::create(['name' => 'delete records']);

        Permission::create(['name' => 'list subrecords']);
        Permission::create(['name' => 'view subrecords']);
        Permission::create(['name' => 'create subrecords']);
        Permission::create(['name' => 'update subrecords']);
        Permission::create(['name' => 'delete subrecords']);

        Permission::create(['name' => 'list useractivitylogs']);
        Permission::create(['name' => 'view useractivitylogs']);
        Permission::create(['name' => 'create useractivitylogs']);
        Permission::create(['name' => 'update useractivitylogs']);
        Permission::create(['name' => 'delete useractivitylogs']);

        Permission::create(['name' => 'list usergalleries']);
        Permission::create(['name' => 'view usergalleries']);
        Permission::create(['name' => 'create usergalleries']);
        Permission::create(['name' => 'update usergalleries']);
        Permission::create(['name' => 'delete usergalleries']);

        Permission::create(['name' => 'list useruploads']);
        Permission::create(['name' => 'view useruploads']);
        Permission::create(['name' => 'create useruploads']);
        Permission::create(['name' => 'update useruploads']);
        Permission::create(['name' => 'delete useruploads']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
