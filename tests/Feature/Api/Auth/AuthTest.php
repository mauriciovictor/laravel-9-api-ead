<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\TestTrait;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use TestTrait;

    public function test_fail_auth()
    {
        $response = $this->postJson('/auth', []);

        $response->assertStatus(422);
    }

    public function test_auth()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/auth', [
            'email' => $user->email,
            'password' => 'password',
            'device_name' => "teste"
        ]);

        $response->dump();

        $response->assertStatus(200);
    }

    public function test_logout()
    {
        $response = $this->postJson('/logout');
        $response->assertStatus(401);
    }

    public function test_error_logout()
    {
        $token = $this->createTokenUser();
        $response = $this->postJson('/logout', [], [
            'authorization' => "Bearer {$token}"
        ]);
        $response->assertStatus(200);
    }

    public function test_error_me()
    {
        $response = $this->getJson('/me');
        $response->assertStatus(401);
    }

    public function test_me()
    {
        $token = $this->createTokenUser();

        $response = $this->getJson('/me', ['authorization' => "Bearer {$token}"]);
        $response->assertStatus(200);
    }
}
