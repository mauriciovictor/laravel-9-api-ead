<?php

namespace App\Repositories;

use App\Models\ReplySupport;

use App\Repositories\Traits\RepositoryTrait;

class ReplySupportRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(ReplySupport $model)
    {
        $this->entity = $model;
    }

    public function create(array $props)
    {
        $user = $this->getUserAutenticated();


        return $this->entity->create([
            'support_id' => $props['support_id'],
            'description' => $props['description'],
            'user_id' => $user->id,
        ]);
    }
}
