<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class viewItemTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/api/items');

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'item_name',
                    'item_desc',
                    'price',
                    'quantity'
                ],
            ]);
    }

    public function testItemIsCreatedSuccessfully()
    {
        $itemDetails = [
            'item_name' => 'testing',
            'item_desc' => 'testing',
            'price' => 12000,
            'quantity' => 5
        ];

        $this->json('post', 'api/user', $itemDetails)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => [
                        'item_name',
                        'item_desc',
                        'price',
                        'quantity'
                    ]
                ]
            );
        $this->assertDatabaseHas('items', $itemDetails);
    }
}
