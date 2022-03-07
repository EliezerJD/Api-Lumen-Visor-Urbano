<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = 'admin1234';
        $user->role_id  = 1;
        $user->save();

        $user = new User();
        $user->name = 'User';
        $user->email = 'user@user.com';
        $user->password = 'user1234';
        $user->role_id  = 2;
        $user->save();
        
    }
}