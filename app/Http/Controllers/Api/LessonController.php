<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Repositories\LessonRepository;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $repository;

    public function __construct(LessonRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($id)
    {
        $lessons = $this->repository->findAllByModule($id);

        return LessonResource::collection($lessons);
    }

    public function show($id)
    {
        $lesson = $this->repository->findById($id);

        return new LessonResource($lesson);
    }
}
