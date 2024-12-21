<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB, Hash;
class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'root',
            'username' => 'root',
            'role' => 'admin',
            'password' => Hash::make('KacangGelap_100403'),
        ]);
        DB::table('users')->insert([
            'name' => 'dummy',
            'username' => 'dummy',
            'role' => 'user',
            'password' => Hash::make('d!u@m#m$y'),
        ]);
    }
}
