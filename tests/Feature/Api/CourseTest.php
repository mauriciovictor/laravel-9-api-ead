<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use TestTrait;

    public function test_unauthenticated()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_all_course()
    {


        $response = $this->getJson('/courses', $this->defaultHeaders());

        $response->assertStatus(200);
    }

    public function test_get_all_courses_total()
    {
        $courses = Course::factory()->count(10)->create();

        $response = $this->getJson('/courses', $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(count($courses), 'data');
    }


    public function test_get_single_course_unauthenticated()
    {
        $response = $this->getJson('/courses/fake_id');
        $response->assertStatus(401);
    }

    public function test_get_single_course_not_found()
    {

        $response = $this->getJson("/courses/fake_id", $this->defaultHeaders());
        $response->assertStatus(404);
    }

    public function test_get_single_course()
    {
        $course = Course::factory()->create();
        $response = $this->getJson("/courses/{$course->id}", $this->defaultHeaders());
        $response->assertStatus(200);
    }
}
