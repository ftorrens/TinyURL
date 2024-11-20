<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_special_token_validation(): void
    {
        $token = '{([)}';
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->post('api/v1/short-urls');

        $response->assertStatus(401);
    }

    public function test_url_parameter_is_required(): void
    {
        $token = '{([])}';
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->post('api/v1/short-urls');

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The url parameter is required.',
                'errors' => [
                    'url' => [
                        'The url parameter is required.'
                    ]
                ]
            ]);
    }

    public function test_url_parameter_format(): void
    {
        $token = '{([])}';
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->post('api/v1/short-urls?url=example_url');

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The url parameter does not have a valid format.',
                'errors' => [
                    'url' => [
                        'The url parameter does not have a valid format.'
                    ]
                ]
            ]);
    }

    public function test_response_success_format(): void
    {
        $token = '{([])}';
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->post('api/v1/short-urls?url=https://www.ford.es/');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'url' => []
            ]);
    }
}
