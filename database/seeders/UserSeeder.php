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
        $user->password = '$2y$10$RPYiTuxjhQZMvjYSn4zaJOzATHOkWE75UJoUdSpoXh8S8KZeH8HSi';
        $user->role_id  = 1;
        $user->save();

        $user = new User();
        $user->name = 'User';
        $user->email = 'user@user.com';
        $user->password = '$2y$10$h7oN/bri9OCEDs.ACzS82O18evx9d5qSHiPZnPsEFWrMViRZsm/ru';
        $user->role_id  = 2;
        $user->save();
        
    }
}