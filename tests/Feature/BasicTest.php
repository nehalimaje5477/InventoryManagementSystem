<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BasicTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        //$response = $this->get('/api/items');

        $requst = [
            'category_name' => 'phpunit testing',
            'category_desc' => 'phpunit testing'
        ];

        $this->json('POST', route('/api/category'), $requst)
            ->assertStatus(201)
            ->assertJson(['data' => $requst]);
        //$response->assertStatus(200);
        $this->assertDatabaseHas('inventory_system', $requst);
    }
}
