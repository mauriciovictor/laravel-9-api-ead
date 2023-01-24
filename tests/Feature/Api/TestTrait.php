<?php

namespace Tests\Feature\Api;

use App\Models\User;

trait TestTrait
{

    public function createUser(): User
    {
        $user = User::factory()->create();

        return $user;
    }

    public function createTokenUser()
    {


        $token = $this->createUser()->createToken('teste')->plainTextToken;

        return $token;
    }

    public function defaultHeaders()
    {
        return  [
            'Authorization' =>  "Bearer {$this->createTokenUser()}"
        ];
    }
}
