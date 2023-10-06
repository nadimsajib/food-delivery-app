<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RiderTracking;

class RiderTrackingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        RiderTracking::truncate();

        // Insert sample data
        RiderTracking::create([
            'rider_id' => 1,
            'lat' => 40.7143,
            'long' => -74.006,
            'timestamp' => now()->subMinutes(2), // Example timestamp from 2 minutes ago
        ]);

        RiderTracking::create([
            'rider_id' => 2,
            'lat' => 34.0522,
            'long' => -118.2437,
            'timestamp' => now()->subMinutes(5), // Example timestamp from 5 minutes ago
        ]);
    }
}
