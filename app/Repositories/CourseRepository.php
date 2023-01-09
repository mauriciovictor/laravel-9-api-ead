<?php

namespace App\Repositories;

use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseRepository
{

    protected $entity;

    public function __construct(Course $model)
    {
        $this->entity = $model;
    }

    public function findAll()
    {
        $courses = $this->entity::get();

        return CourseResource::collection($courses);
    }

    public function findById(string $id)
    {
        $course = $this->entity::findOrFail($id);


        return new CourseResource($course);
    }
}
