<?php



use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\IotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('user', [UserController::class, 'index']);
Route::post('user', [UserController::class, 'store']);
Route::get('user/{id}', [UserController::class, 'show']);
Route::get('user/{id}/edit', [UserController::class, 'edit']);
Route::put('user/{id}', [UserController::class, 'update']);
Route::delete('user/{id}', [UserController::class, 'destroy']);

Route::get('iot', [IotController::class, 'index']);
Route::post('iot', [IotController::class, 'store']);
Route::get('iot/{id}', [IotController::class, 'show']);
Route::get('iot/{id}/edit', [IotController::class, 'edit']);
Route::put('iot/{id}', [IotController::class, 'update']);
Route::delete('iot/{id}', [IotController::class, 'destroy']);

Route::get('control', [ControlController::class, 'index']);
Route::post('control', [ControlController::class, 'store']);
Route::get('control/{id}', [ControlController::class, 'show']);
Route::get('control/{id}/edit', [ControlController::class, 'edit']);
Route::put('control/{id}', [ControlController::class, 'update']);
Route::delete('control/{id}', [ControlController::class, 'destroy']);


Route::get('admin', [AdminController::class, 'index']);
Route::post('admin', [AdminController::class, 'store']);
Route::get('admin/{id}', [AdminController::class, 'show']);
Route::get('admin/{id}/edit', [AdminController::class, 'edit']);
Route::put('admin/{id}', [AdminController::class, 'update']);
Route::delete('admin/{id}', [AdminController::class, 'destroy']);

Route::get('notif', [NotifController::class, 'index']);
Route::post('notif', [NotifController::class, 'store']);
Route::get('notif/{id}', [NotifController::class, 'show']);
Route::get('notif/{id}/edit', [NotifController::class, 'edit']);
Route::put('notif/{id}', [NotifController::class, 'update']);
Route::delete('notif/{id}', [NotifController::class, 'destroy']);

