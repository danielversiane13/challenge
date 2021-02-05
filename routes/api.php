<?php

use App\Http\Controllers\MiddlewareController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('transactions', TransactionController::class)->only(['index', 'store']);

Route::get('any-route', [MiddlewareController::class, 'index'])->middleware('permission:any_index');
