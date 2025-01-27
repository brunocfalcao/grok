<?php

use Nidavellir\Thor\Models\System;
use Illuminate\Support\Facades\Route;
use Nidavellir\Grok\Controllers\AccountDashboardController;

Route::get('/', function () {
    return view('grok::welcome');
});

Route::get('/stop', function () {
    System::update(['can_process_scheduled_tasks' => false]);
    return 'Scheduled tasks stopped. Bot is down.';
});

Route::get('/accounts/{uuid}/dashboard', [AccountDashboardController::class, 'show']);
