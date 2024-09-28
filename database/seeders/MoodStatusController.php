<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoodStatusController extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mood_statuses')->insert([
            ['name'=>'Active'],
            ['name'=>'Do not Disturb '],
            ['name'=>'Invisible']
        ]);
    }
}
