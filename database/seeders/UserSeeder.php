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
            'name' => 'admin',
            'fullname' => 'Administrator',
            'pass' => md5('aXd'.'qq'.'dXa'),
            'email' => 'gellei.csaba@gmail.com',
        ]);
        DB::table('users')->insert([
            'name' => 'test',
            'fullname' => 'Test User',
            'pass' => md5('aXd'.'teSt'.'dXa'),
            'email' => 'test.user@gmail.com',
        ]);
    }
}
