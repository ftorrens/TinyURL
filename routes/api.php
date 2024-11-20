<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SpecialToken;
use App\Http\Controllers\TinyURLController;

Route::post('/v1/short-urls', [TinyURLController::class, 'index'])->middleware(SpecialToken::class);
