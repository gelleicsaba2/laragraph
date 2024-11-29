<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for ($x = 0; $x < 100; ++$x) {
            $text = $faker->text();
            $sdate = date('Y-m-d H:i:s', strtotime("+".strval($x)." day"));
            $edate = date('Y-m-d', strtotime("+".strval($x)." day")) . ' 23:59:59';
            DB::table('todos')->insert([
                'todo' => $text,
                'todo_start' => $sdate,
                'todo_end' => $edate,
                'uid' => 1,
            ]);
        }
    }
}
