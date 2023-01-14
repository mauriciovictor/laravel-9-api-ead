<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplySupport;
use App\Http\Resources\ReplyResource;
use App\Repositories\ReplySupportRepository;

class ReplySupportController extends Controller
{
    protected $repository;

    public function __construct(ReplySupportRepository $repository)
    {
        $this->repository = $repository;
    }

    public function storeReply(StoreReplySupport $request)
    {

        $reply = $this->repository->create($request->validated());
        return  new ReplyResource($reply);
    }
}
