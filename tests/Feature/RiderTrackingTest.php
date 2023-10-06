<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RiderTrackingTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGetNearestRider()
    {
        $response = $this->get('/api/nearest-rider/1');

        $response->assertStatus(200);
        $response->assertJsonStructure(['rider_id', 'distance']);
    }
}
