<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FollowersTableSeeder extends Seeder
{
    public function run()
    {
        $userCount = 500; // Number of users
        $faker = \Faker\Factory::create();

        foreach (range(1, $userCount) as $userId) {
            $followerCount = rand(300, 500); // Number of followers per user

            for ($i = 0; $i < $followerCount; $i++) {
                DB::table('followers')->insert([
                    'id' => $userId,
                    'name' => $faker->name,
                    'read_at' => $faker->boolean(50) ? Carbon::now() : null,
                    'created_at' => Carbon::now()->subMonths(3)->addDays(rand(0, 90)), // 3 months ago to now
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
