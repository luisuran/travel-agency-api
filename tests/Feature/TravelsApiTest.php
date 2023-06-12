<?php

namespace Tests\Feature;

use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TravelsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_travels_list_returns_paginated_data_correctly()
    {
        Travel::factory()->count(15)->create(['is_public' => true]);

        $response = $this->getJson('/api/v1/travels');

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
        $response->assertJsonPath('meta.last_page', 3);
    }

    public function test_travels_list_only_returns_public_travels()
    {
        Travel::factory()->count(3)->create(['is_public' => true]);
        Travel::factory()->count(13)->create(['is_public' => false]);

        $response = $this->getJson('/api/v1/travels');

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
        $response->assertJsonMissing(['is_public' => false]);
    }
}
