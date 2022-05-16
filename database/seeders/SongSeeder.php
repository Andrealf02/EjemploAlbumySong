<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::table('song')->insert([
            'songId' => 1,
            'usersId' => 1,
            'action' => 'like',
            'elementId' => 1,
        ]);
    }
}
