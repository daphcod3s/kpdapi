<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsAndRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Forget cached roles and permissions
    	app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    	// create permissions
    	Permission::create(['name' => 'add-cuisine']);
    	Permission::create(['name' => 'update-cuisine']);
    	Permission::create(['name' => 'delete-cuisine']);
    	Permission::create(['name' => 'add-restaurant']);
    	Permission::create(['name' => 'update-restaurant']);
    	Permission::create(['name' => 'delete-restaurant']);

    	// create roles and assign permissions
    	// Super Admin will have all permissions by default
    	Role::create(['name' => 'Super Admin']);
    	//Admin Roles
    	$role = Role::create(['name' => 'Admin']);
    	$role->givePermissionTo([
    		'add-cuisine',
    		'update-cuisine',
    		'delete-cuisine',
    		'add-restaurant',
    		'update-restaurant',
    		'delete-restaurant'
    	]);
    }
}
