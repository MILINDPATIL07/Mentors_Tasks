<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
               'name'=>'Admin',
               'email'=>'testuser1@kcsitglobal.com',
            //    'usertype'=>0,
               'password'=> bcrypt('secret'),  
        ]);
    }
}
