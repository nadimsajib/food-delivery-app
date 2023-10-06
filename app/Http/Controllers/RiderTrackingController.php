<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiderTracking;
use App\Models\Restaurant;

class RiderTrackingController extends Controller
{
    //
    public function saveRiderInfo(Request $request)
    {
        
        $validator = $request->validate([
            'rider_id' => 'required',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
            //'timestamp' => 'required|date',
        ]);
        $data = $request->all();
        $data['timestamp'] = now();

        RiderTracking::create($data);

        return response()->json(['message' => 'Rider information saved successfully'], 201);
    }

    public function getNearestRider($restaurant_id)
    {
        // Get the latest rider location within the last 5 minutes
        $latestLocation = RiderTracking::where('created_at', '>=', now()->subMinutes(5))
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$latestLocation) {
            return response()->json(['message' => 'No rider found within the last 5 minutes'], 404);
        }
        // Fetch restaurant coordinates from the database
        $restaurant = Restaurant::find($restaurant_id);

        // Calculate the distance between restaurant and rider using Haversine formula
        $distance = $this->calculateHaversineDistance(
            $latestLocation->lat,
            $latestLocation->long,
            $restaurant->lat,
            $restaurant->long
        );

        return response()->json(['rider_id' => $latestLocation->rider_id, 'distance' => $distance]);
    }
    //https://stackoverflow.com/a/10054282
    private function calculateHaversineDistance($lat1, $long1, $lat2, $long2)
    {
        // Radius of the Earth in kilometers
        $earthRadius = 6371;

        // convert from degrees to radians
        $latDiff = deg2rad($lat2 - $lat1);
        $longDiff = deg2rad($long2 - $long1);

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($longDiff / 2) * sin($longDiff / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Distance in kilometers
        $distance = $earthRadius * $c;

        return $distance;
    }
}
