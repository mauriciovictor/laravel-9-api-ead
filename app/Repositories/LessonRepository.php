<?php

namespace App\Repositories;


use App\Models\Lesson;
use App\Repositories\Traits\RepositoryTrait;

class LessonRepository
{
    use RepositoryTrait;

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
        return $this->entity::findOrFail($lessonId);
    }

    public function markLessonViewed(string $lesson_id)
    {
        $user =  $this->getUserAutenticated();

        $viewed = $user->views()->where('lesson_id', $lesson_id)->first();

        if ($viewed) {
            return $viewed->update([
                'qty' => $viewed->qty + 1
            ]);
        }

        return $user->views()->create([
            'lesson_id' => $lesson_id
        ]);
    }
}
