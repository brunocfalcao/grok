<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Nidavellir\Grok\Controllers\AccountDashboardController;
use Nidavellir\Thor\Models\System;
use Nidavellir\Thor\Models\User;

Route::get('/', function () {
    return view('grok::welcome');
});

Route::get('/stop', function () {
    try {
        // Retrieve the System instance and update it
        $system = System::first();
        if (! $system) {
            return response()->json([
                'status' => 'error',
                'message' => 'System record not found. Cannot stop scheduled tasks.',
                'timestamp' => now(),
            ], 404);
        }

        $system->update(['can_process_scheduled_tasks' => false]);

        // Fetch the last completed job ID using raw SQL
        $lastId = DB::table('core_job_queue')
            ->where('status', 'completed')
            ->orderBy('id', 'desc')
            ->limit(1)
            ->value('id');

        User::admin()->get()->each(function ($user) use ($lastId) {
            $user->pushover(
                message: 'Bot stopped the scheduled tasks. Last ID: '.($lastId ?? 'N/A'),
                title: 'Bot scheduled tasks stopped',
                applicationKey: 'nidavellir_warnings'
            );
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Scheduled tasks have been stopped. The bot is now down. Last Core Job Queue ID processed: '.($lastId ?? 'N/A'),
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
        if (! $system) {
            return response()->json([
                'status' => 'error',
                'message' => 'System record not found. Cannot start scheduled tasks.',
                'timestamp' => now(),
            ], 404);
        }

        $system->update(['can_process_scheduled_tasks' => true]);

        // Fetch the first pending job ID using raw SQL
        $firstId = DB::table('core_job_queue')
            ->where('status', 'pending')
            ->orderBy('id', 'asc')
            ->limit(1)
            ->value('id');

        User::admin()->get()->each(function ($user) use ($firstId) {
            $user->pushover(
                message: 'Bot started processing scheduled tasks. First pending ID: '.($firstId ?? 'N/A'),
                title: 'Bot scheduled tasks started',
                applicationKey: 'nidavellir_warnings'
            );
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Scheduled tasks have been started. The bot is now running. First Core Job Queue ID to process: '.($firstId ?? 'N/A'),
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
