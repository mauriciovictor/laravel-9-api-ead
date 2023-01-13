<?php

namespace App\Repositories;


use App\Models\Support;
use App\Models\User;

class SupportRepository
{

    protected $entity;

    public function __construct(Support $model)
    {
        $this->entity = $model;
    }

    public function find(array $filters = [])
    {

        $supports = $this->getUserAutenticated()
            ->supports()
            ->where(function ($query) use ($filters) {
                if (isset($filters['lesson'])) {
                    $query->where('lesson_id', $filters['lesson']);
                }

                if (isset($filters['filter'])) {
                    $filter = $filters['filter'];
                    $query->where('description', 'LIKE', "%{$filter}%");
                }
            })
            ->get();

        return $supports;
    }

    public function create(array $props): Support
    {
        $support = $this->getUserAutenticated()->supports()->create([
            'lesson_id' => $props['lesson_id'],
            'description' => $props['description'],
            'status' => $props['status']
        ]);

        return $support;
    }

    private function getUserAutenticated(): User
    {
        // return auth()->user();
        return User::first();
    }
}
