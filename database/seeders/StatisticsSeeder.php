<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('song')->insert([
            'Id' => 1,
            'albumId' => 1,
            'songId' => 1,
            'like' => 1,
        ]);
    }
}
