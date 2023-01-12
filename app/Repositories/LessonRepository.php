<?php

namespace App\Repositories;


use App\Models\Lesson;

class LessonRepository
{

    protected $entity;

    public function __construct(Lesson $model)
    {
        $this->entity = $model;
    }

    public function findAllByModule(string $moduleId)
    {
        return $this->entity::where('module_id', $moduleId)->get();
    }

    public function findById(string $lessonId)
    {
        return $this->entity::where('id', $lessonId)->get();
    }
}
