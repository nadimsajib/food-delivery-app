<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data to avoid duplicate entries
        DB::table('restaurants')->truncate();

        // Insert sample data
        DB::table('restaurants')->insert([
            ['restaurant_id' => '1', 'lat' => 40.7128, 'long' => -74.0060], // Example coordinates for New York City
            ['restaurant_id' => '2', 'lat' => 34.0522, 'long' => -118.2437], // Example coordinates for Los Angeles
            // Add more sample data as needed
        ]);
    }
}
