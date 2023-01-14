<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplySupport;
use App\Http\Requests\StoreSupport;
use App\Http\Resources\ReplyResource;
use App\Http\Resources\SupportResource;
use App\Models\Support;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $repository;

    public function __construct(SupportRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $supports = $this->repository->find($request->all());

        return SupportResource::collection($supports);
    }

    public function storeReply(StoreReplySupport $request, $support_id)
    {

        $reply = $this->repository->createReplyToSupport($support_id, $request->validated());
        return  new ReplyResource($reply);
    }

    public function store(StoreSupport $request)
    {

        $support = $this->repository->create($request->validated());
        return new SupportResource($support);
    }
}
