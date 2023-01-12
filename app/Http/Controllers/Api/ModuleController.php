<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Repositories\CourseRepository;
use App\Repositories\ModuleRepository;

class ModuleController extends Controller
{
    protected $repository;

    public function __construct(ModuleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($id)
    {
        $modules = $this->repository->findAllByCourse($id);

        return ModuleResource::collection($modules);
    }
}
