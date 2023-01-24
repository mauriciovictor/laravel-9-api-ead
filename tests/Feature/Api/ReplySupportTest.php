<?php

namespace Tests\Feature\Api;

use App\Models\Support;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReplySupportTest extends TestCase
{
    use TestTrait;

    public function test_create_reply_to_support_unauthenticated()
    {
        $response = $this->postJson('/replies');

        $response->assertStatus(401);
    }

    public function test_create_reply_to_error_validations()
    {
        $response = $this->postJson('/replies', [], $this->defaultHeaders());

        $response->assertStatus(422);
    }

    public function test_create_reply_to_support()
    {

        $support = Support::factory()->create();
        $payload = [
            'support_id' => $support->id,
            'description' => "Description oloco meu"
        ];

        $response = $this->postJson('/replies', $payload, $this->defaultHeaders());

        $response->assertStatus(201);
    }
}
