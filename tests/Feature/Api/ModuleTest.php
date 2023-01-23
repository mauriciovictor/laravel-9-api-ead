<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    use TestTrait;

    public function test_get_modules_unathenticated()
    {
        $response = $this->getJson('/courses/fake_id/modules');

        $response->assertStatus(401);
    }

    public function test_get_modules_not_found()
    {
        $response = $this->getJson('/courses/fake_id/modules', $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(0, 'data');
    }

    public function test_get_modules()
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/courses/{$course->id}/modules", $this->defaultHeaders());

        $response->assertStatus(200);
    }

    public function test_get_modules_course_total()
    {
        $course = Course::factory()->create();

        Module::factory()->count(10)->create(['course_id' => $course->id]);

        $response = $this->getJson("/courses/{$course->id}/modules", $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }
}
