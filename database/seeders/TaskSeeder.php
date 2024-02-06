<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            [
                'name' => '資料作成',
                'created_at' => Now(),
            ],
            [
                'name' => '〇〇会議の出席',
                'created_at' => Now(),
            ],
            [
                'name' => '〇〇の提出',
                'created_at' => Now(),
            ]
            ]);
    }
}
