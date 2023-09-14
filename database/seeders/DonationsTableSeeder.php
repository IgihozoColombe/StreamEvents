<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Donation;
use Carbon\Carbon;

class DonationsTableSeeder extends Seeder
{
    public function run()
    {
        $userCount = 500; // Number of users
        $faker = \Faker\Factory::create();

        foreach (range(1, $userCount) as $userId) {
            $donationCount = rand(300, 500); // Number of donations per user

            for ($i = 0; $i < $donationCount; $i++) {
                Donation::table('donations')->insert([
                    'id' => $userId,
                    'amount' => $faker->randomFloat(2, 1, 1000), // Example: 100.00
                    'currency' => 'USD',
                    'donation_message' => $faker->sentence,
                    'read_at' => $faker->boolean(50) ? Carbon::now() : null,
                    'created_at' => Carbon::now()->subMonths(3)->addDays(rand(0, 90)), // 3 months ago to now
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
