<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SpecialToken;

Route::post('/v1/short-urls', function () {
    return response()->json([
        'status' => 'Success',
        'mensaje' => 'Your token is valid'
    ], 200);
})->middleware(SpecialToken::class);   
