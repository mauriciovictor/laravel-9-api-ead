<?php

namespace App\Repositories;


use App\Models\Support;
use App\Models\User;
use App\Repositories\Traits\RepositoryTrait;

class SupportRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(Support $model)
    {
        $this->entity = $model;
    }

    public function findUserSupports(array $filters = [])
    {
        $filters['user'] = true;
        return $this->find($filters);
    }

    public function find(array $filters = [])
    {

        $supports = $this->entity

            ->where(function ($query) use ($filters) {
                if (isset($filters['lesson'])) {
                    $query->where('lesson_id', $filters['lesson']);
                }

                if (isset($filters['status'])) {
                    $query->where('status', $filters['status']);
                }

                if (isset($filters['filter'])) {
                    $filter = $filters['filter'];
                    $query->where('description', 'LIKE', "%{$filter}%");
                }

                if (isset($filters['user'])) {

                    $user = $this->getUserAutenticated();

                    $query->where('user_id', $user->id);
                }
            })
            ->orderBy('updated_at')
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

    public function createReplyToSupport(string $support_id, array $props)
    {
        $user = $this->getUserAutenticated();

        return $this->getSupport($support_id)->replies()->create([
            'description' => $props['description'],
            'user_id' => $user->id,
        ]);
    }

    public function getSupport(string $id)
    {
        return $this->entity->findOrFail($id);
    }
}
