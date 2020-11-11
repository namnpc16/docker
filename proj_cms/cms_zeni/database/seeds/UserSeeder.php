<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'phuong nam',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'role' => 1,
            'remember_token' => 'adfasdfadsf314132',
        ]);
    }
}
