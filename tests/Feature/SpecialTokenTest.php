<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpecialTokenTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $token = '{([])}';
        $response = $this->withHeaders(['Authorization'=>'Bearer '.$token,
							    'Accept' => 'application/json'])->post('api/v1/short-urls');

        $response->assertStatus(200);
    }
}
