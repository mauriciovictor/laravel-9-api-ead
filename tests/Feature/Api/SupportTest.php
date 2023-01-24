<?php

namespace Tests\Feature\Api;

use App\Models\Support;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SupportTest extends TestCase
{

    use TestTrait;

    public function test_get_my_supports_unathenticated()
    {
        $response = $this->getJson('/users/supports');

        $response->assertStatus(401);
    }

    public function test_get_my_supports()
    {
        $user = $this->createUser();;

        Support::factory()->count(50)->create([
            'user_id' => $user->id
        ]);

        Support::factory(50)->create();

        $token = $user->createToken('teste')->plainTextToken;

        $response = $this->getJson('/users/supports', [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200)->assertJsonCount(50, 'data');
    }
}
