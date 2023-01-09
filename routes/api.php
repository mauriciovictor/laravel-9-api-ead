<?php

use Dotenv\Repository\RepositoryInterface;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        "success" => true
    ]);
});
