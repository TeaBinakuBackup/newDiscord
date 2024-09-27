<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendRequestStatuseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('request_statuses')->insert([
            ['name' => 'Pending'],
            ['name' => 'Accepted'],
            ['name' => 'Rejected']
        ]);

    }
}
