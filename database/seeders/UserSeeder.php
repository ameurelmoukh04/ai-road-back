<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=> 'ameur',
            'email'=> 'ameur@gmail.com',
            'role'=> 'user',
            'password'=> '$2y$12$qq1Ow5LPpamP6VQ3cwtY9ed5DnwE9HPyU3xaY7K2MZZRDkrl6G45C',
        ]);
        DB::table('users')->insert([
            'name'=> 'karam',
            'email'=> 'karam@gmail.com',
            'role'=> 'user',
            'password'=> '$2y$12$qq1Ow5LPpamP6VQ3cwtY9ed5DnwE9HPyU3xaY7K2MZZRDkrl6G45C',
        ]);
        DB::table('users')->insert([
            'name'=> 'saad',
            'email'=> 'saad@gmail.com',
            'role'=> 'admin',
            'password'=> '$2y$12$qq1Ow5LPpamP6VQ3cwtY9ed5DnwE9HPyU3xaY7K2MZZRDkrl6G45C',
        ]);
    }
}
