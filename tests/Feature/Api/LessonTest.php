<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use TestTrait;

    public function test_get_lessons_unathenticated()
    {
        $response = $this->getJson('/modules/fake_id/lessons');

        $response->assertStatus(401);
    }

    public function test_get_lessons_not_found()
    {
        $response = $this->getJson('/modules/fake_id/lessons', $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(0, 'data');
    }

    public function test_get_lessons()
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/modules/{$course->id}/lessons", $this->defaultHeaders());

        $response->assertStatus(200);
    }

    public function test_get_lessons_course_total()
    {

        $course = Course::factory()->create();

        $module = Module::factory()->create(['course_id' => $course->id]);

        Lesson::factory()->count(10)->create(['module_id' => $module->id]);

        $response = $this->getJson("/modules/{$module->id}/lessons", $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    public function test_get_single_lesson_unathenticated()
    {

        $response = $this->getJson("/lessons/fake_value");

        $response->assertStatus(401);
    }

    public function test_get_single_lesson_not_found()
    {

        $response = $this->getJson("/lessons/fake_value", $this->defaultHeaders());

        $response->assertStatus(404);
    }

    public function test_get_single_lesson()
    {
        $lesson = Lesson::factory()->create();

        $response = $this->getJson("/lessons/{$lesson->id}", $this->defaultHeaders());

        $response->assertStatus(200);
    }
}
