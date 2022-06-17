<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
               'name'=>'User',
               'email'=>'milind@gmail.com',
               'type'=>0,
               'password'=> bcrypt('Pass@123'),
            ],
            [
               'name'=>'Super Admin User',
               'email'=>'testuser@kcsitglobal.com',
               'type'=>1,
               'password'=> bcrypt('secret'),
            ],
            
        ];
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
    
       
