<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CampaignTypeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('events', EventController::class);

Route::get('/channels', [ChannelController::class, 'index']);
Route::get('/campaign-types', [CampaignTypeController::class, 'index']);