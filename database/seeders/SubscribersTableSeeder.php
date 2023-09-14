<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Subscriber;
use Carbon\Carbon;

class SubscribersTableSeeder extends Seeder
{
    public function run()
    {
        $userCount = 500; // Number of users
        $faker = \Faker\Factory::create();

        foreach (range(1, $userCount) as $userId) {
            $subscriberCount = rand(300, 500); // Number of subscribers per user

            for ($i = 0; $i < $subscriberCount; $i++) {
                Subscriber::table('subscriber')->insert([
                    'id' => $userId,
                    'subscriber_name' => $faker->name,
                    'subscription_tier' => rand(1, 3), // Random subscription tier (1, 2, or 3)
                    'read_at' => $faker->boolean(50) ? Carbon::now() : null,
                    'created_at' => Carbon::now()->subMonths(3)->addDays(rand(0, 90)), // 3 months ago to now
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}