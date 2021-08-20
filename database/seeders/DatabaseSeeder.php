<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $table = 'users';
        // $column = 'unique_id';
        // $unique_id = $this->createUniqueID($table, $column);

        $user1 = \App\Models\User::create([
            'first_name'=>"Presh",
            'last_name'=>"Ani",
            'email'=>"anipreciousebuka@gmail.com",
            'password'=>Hash::make('preshdev'),
            'isAdmin'=>"1",
            'unique_id'=>"123456"
        ]);
    }
}
