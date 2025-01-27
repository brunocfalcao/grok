<?php

use Nidavellir\Thor\Models\User;
use Nidavellir\Thor\Models\System;
use Illuminate\Support\Facades\Route;
use Nidavellir\Grok\Controllers\AccountDashboardController;

Route::get('/', function () {
    return view('grok::welcome');
});

Route::get('/stop', function () {
    try {
        // Retrieve the System instance and update it
        $system = System::first();
        if (!$system) {
            return response()->json([
                'status' => 'error',
                'message' => 'System record not found. Cannot stop scheduled tasks.',
                'timestamp' => now(),
            ], 404);
        }

        $system->update(['can_process_scheduled_tasks' => false]);

        $lastId = CoreJobQueue::where('status', 'completed')->latest()->first()?->id;

        User::admin()->get()->each(function ($user) use ($lastId) {
            $user->pushover(
                message: "Bot stopped the scheduled tasks. Last ID: " . $lastId,
                title: 'Bot scheduled tasks stopped',
                applicationKey: 'nidavellir_warnings'
            );
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Scheduled tasks have been stopped. The bot is now down. Last Core Job Queue ID processed: ' . $lastId,
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

Route::get('/start', function () {
    try {
        // Retrieve the System instance and update it
        $system = System::first();
        if (!$system) {
            return response()->json([
                'status' => 'error',
                'message' => 'System record not found. Cannot start scheduled tasks.',
                'timestamp' => now(),
            ], 404);
        }

        $system->update(['can_process_scheduled_tasks' => true]);

        $firstId = CoreJobQueue::where('status', 'pending')->oldest()->first()?->id;

        User::admin()->get()->each(function ($user) use ($firstId) {
            $user->pushover(
                message: "Bot started processing scheduled tasks. First pending ID: " . $firstId,
                title: 'Bot scheduled tasks started',
                applicationKey: 'nidavellir_warnings'
            );
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Scheduled tasks have been started. The bot is now running. First Core Job Queue ID to process: ' . $firstId,
            'timestamp' => now(),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to start scheduled tasks. Please check the logs for more details.',
            'error' => $e->getMessage(),
            'timestamp' => now(),
        ], 500);
    }
});

Route::get('/accounts/{uuid}/dashboard', [AccountDashboardController::class, 'show']);
