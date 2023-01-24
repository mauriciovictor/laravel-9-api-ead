<?php

namespace Tests\Feature\Api;

use App\Models\Lesson;
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

    public function test_get_supports_unathenticated()
    {

        $response = $this->getJson('/supports');

        $response->assertStatus(401);
    }

    public function test_get_supports()
    {
        Support::factory(50)->create();

        $response = $this->getJson('/supports', $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(50, 'data');
    }

    public function test_get_supports_filter_lesson()
    {
        $lesson = Lesson::factory()->create();
        Support::factory(50)->create();
        Support::factory(10)->create(['lesson_id'  => $lesson->id]);

        $payload = [
            'lesson' => $lesson->id
        ];

        $response = $this->json('GET', '/supports', $payload, $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }
}
