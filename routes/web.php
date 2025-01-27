<?php

use Nidavellir\Thor\Models\System;
use Illuminate\Support\Facades\Route;
use Nidavellir\Grok\Controllers\AccountDashboardController;

Route::get('/', function () {
    return view('grok::welcome');
});

Route::get('/stop', function () {
    try {
        System::update(['can_process_scheduled_tasks' => false]);
        return response()->json([
            'status' => 'success',
            'message' => 'Scheduled tasks have been stopped. The bot is now down.',
            'timestamp' => now(),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to stop scheduled tasks. Please check the logs for more details.',
            'error' => $e->getMessage(),
            'timestamp' => now(),
        ], 500);
    }
});

Route::get('/accounts/{uuid}/dashboard', [AccountDashboardController::class, 'show']);
