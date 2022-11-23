<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::create([
            'name' => 'Admin', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('dev123')
         ])->each(
            function($user){
                $user->assignRole('super-admin');
            }
        );
        User::create([
            'name' => 'Editor', 
            'email' => 'edit@gmail.com',
            'password' => bcrypt('dev123')
        ])->each(
            function($user){
                $user->assignRole('role-editor');
            }
        );
        User::create([
            'name' => 'Viewer', 
            'email' => 'viewer@gmail.com',
            'password' => bcrypt('dev123')
        ])->each(
            function($user){
                $user->assignRole('role-viewer');
            }
        );
    }
}