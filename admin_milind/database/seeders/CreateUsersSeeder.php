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
               'name'=>'Super Admin User',
               'email'=>'testuser@kcsitglobal.com',              
               'password'=> bcrypt('secret'),
               'usertype'=>0,

            ]
            
        ];
       
            User::create($users);
        
    }
}
    
       
