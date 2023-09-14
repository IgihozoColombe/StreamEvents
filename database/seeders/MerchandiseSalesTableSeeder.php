<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\MerchSale;
use Carbon\Carbon;

class MerchandiseSalesTableSeeder extends Seeder
{
    public function run()
    {
        $userCount = 500; // Number of users
        $faker = \Faker\Factory::create();

        foreach (range(1, $userCount) as $userId) {
            $salesCount = rand(300, 500); // Number of sales per user

            for ($i = 0; $i < $salesCount; $i++) {
                MerchSale::table('merch_sales')->insert([
                    'id' => $userId,
                    'item_name' => $faker->word,
                    'amount' => rand(1, 100),
                    'price' => $faker->randomFloat(2, 5, 100), // Example: 29.99
                    'read_at' => $faker->boolean(50) ? Carbon::now() : null,
                    'created_at' => Carbon::now()->subMonths(3)->addDays(rand(0, 90)), // 3 months ago to now
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}