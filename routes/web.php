<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JeopardyController;
use App\Http\Controllers\SimpleCustomController;

// Health check route for deployment monitoring
Route::get('/health', function () {
    return response()->json(['status' => 'healthy', 'timestamp' => now()]);
});

// Existing routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/jeopardy', [App\Http\Controllers\JeopardyController::class, 'index']);
Route::get('/jeopardy/setup', [App\Http\Controllers\JeopardyController::class, 'setup']);
Route::get('/jeopardy/play', [App\Http\Controllers\JeopardyController::class, 'play']);

// Game routes
Route::post('/jeopardy/start', [App\Http\Controllers\JeopardyController::class, 'startGame']);
Route::post('/jeopardy/start-custom', [App\Http\Controllers\JeopardyController::class, 'startCustomGame']);
Route::post('/jeopardy/start-custom-from-lobby', [App\Http\Controllers\JeopardyController::class, 'startCustomGameFromLobby']);
Route::get('/jeopardy/game-state', [App\Http\Controllers\JeopardyController::class, 'getGameState']);
Route::get('/jeopardy/lobby-game-state', [App\Http\Controllers\JeopardyController::class, 'getLobbyGameState']);
Route::post('/jeopardy/update-lobby-game-state', [App\Http\Controllers\JeopardyController::class, 'updateLobbyGameState']);
Route::post('/jeopardy/select-question', [App\Http\Controllers\JeopardyController::class, 'selectQuestion']);
Route::post('/jeopardy/submit-answer', [App\Http\Controllers\JeopardyController::class, 'submitAnswer']);
Route::post('/jeopardy/update-timer', [App\Http\Controllers\JeopardyController::class, 'updateTimer']);
Route::post('/jeopardy/reset', [App\Http\Controllers\JeopardyController::class, 'resetGame']);
Route::post('/jeopardy/reset-lobby-game', [App\Http\Controllers\JeopardyController::class, 'resetLobbyGame']);

// Custom game routes
Route::get('/jeopardy/custom-game', [App\Http\Controllers\JeopardyController::class, 'customGameCreator']);
Route::get('/jeopardy/play-custom', [App\Http\Controllers\JeopardyController::class, 'playCustomGame']);

// Simple custom game routes
Route::get('/jeopardy/simple-custom-game', [App\Http\Controllers\SimpleCustomController::class, 'index']);
Route::post('/jeopardy/simple-start-custom', [App\Http\Controllers\SimpleCustomController::class, 'startGame']);
Route::get('/jeopardy/simple-play-custom', [App\Http\Controllers\SimpleCustomController::class, 'play']);
Route::post('/jeopardy/simple-answer', [App\Http\Controllers\SimpleCustomController::class, 'submitAnswer']);
Route::get('/jeopardy/simple-game-state', [App\Http\Controllers\SimpleCustomController::class, 'getGameState']);
Route::post('/jeopardy/simple-question', [App\Http\Controllers\SimpleCustomController::class, 'selectQuestion']);
Route::post('/jeopardy/simple-timer', [App\Http\Controllers\SimpleCustomController::class, 'updateTimer']);
Route::post('/jeopardy/simple-reset', [App\Http\Controllers\SimpleCustomController::class, 'resetGame']);

// Lobby routes
Route::get('/jeopardy/lobby', [App\Http\Controllers\JeopardyController::class, 'lobbySelection']);
Route::post('/jeopardy/create-lobby', [App\Http\Controllers\JeopardyController::class, 'createLobby']);
Route::post('/jeopardy/join-lobby', [App\Http\Controllers\JeopardyController::class, 'joinLobby']);
Route::get('/jeopardy/lobby/{code}', [App\Http\Controllers\JeopardyController::class, 'lobbyRoom']);
Route::post('/jeopardy/lobby/{code}/start', [App\Http\Controllers\JeopardyController::class, 'startLobbyGame']);
Route::get('/jeopardy/lobby/{code}/status', [App\Http\Controllers\JeopardyController::class, 'getLobbyStatus']);
Route::post('/jeopardy/clear-lobby-info', [App\Http\Controllers\JeopardyController::class, 'clearLobbyInfo']);

// Debug routes
Route::get('/jeopardy/debug/game-state', [App\Http\Controllers\JeopardyController::class, 'debugGameState']);
Route::get('/jeopardy/debug/player', [App\Http\Controllers\JeopardyController::class, 'debugPlayer']);
Route::get('/jeopardy/debug/session', [App\Http\Controllers\JeopardyController::class, 'debugSession']);
Route::get('/jeopardy/debug/team-assignment', [App\Http\Controllers\JeopardyController::class, 'debugTeamAssignment']);
Route::get('/jeopardy/debug/deduction', [App\Http\Controllers\JeopardyController::class, 'testDeduction']);

// Player management routes
Route::post('/jeopardy/switch-player', [App\Http\Controllers\JeopardyController::class, 'switchPlayer']);
Route::post('/jeopardy/auto-assign-player', [App\Http\Controllers\JeopardyController::class, 'autoAssignPlayer']);

// Category routes
Route::get('/jeopardy/categories', [App\Http\Controllers\JeopardyController::class, 'getCategories']);

// Simple custom game debug routes
Route::get('/jeopardy/simple-debug/turn-advancement', [App\Http\Controllers\SimpleCustomController::class, 'testTurnAdvancement']);
Route::get('/jeopardy/simple-debug/turn-sequence', [App\Http\Controllers\SimpleCustomController::class, 'testTurnSequence']);
Route::post('/jeopardy/simple-debug/fix-game-state', [App\Http\Controllers\SimpleCustomController::class, 'fixGameState']);
