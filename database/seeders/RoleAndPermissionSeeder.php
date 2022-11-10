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
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // User
        $addUser = 'add user';
        $editUser ='edit user';
        $deleteUser ='delete user';
        Permission::create(['name' =>$addUser]);
        Permission::create(['name' =>$editUser]);
        Permission::create(['name' =>$deleteUser]);
        // Product
        $addProduct ='add product';
        $editProduct ='edit product';
        $deleteProduct ='delete product';
        Permission::create(['name' =>$addProduct]);
        Permission::create(['name' =>$editProduct]);
        Permission::create(['name' =>$deleteProduct]);
        // Role
        $superAdmin='super-admin';
        $editor='role-editor';
        $viewer='role-viewer';
        Role::create(['name' =>$superAdmin])->givePermissionTo(Permission::all());
        Role::create(['name' =>$editor])->givePermissionTo([
            $editUser,
            $deleteUser,
            $editProduct,
            $deleteProduct
        ]);
        Role::create(['name' =>$viewer])->givePermissionTo([
            $addUser,
            $addProduct,
        ]);
    }
}