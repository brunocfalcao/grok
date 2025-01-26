<?php

use Illuminate\Support\Facades\Route;
use Nidavellir\Grok\Controllers\AccountDashboardController;

Route::get('/', function () {
    return view('grok::welcome');
});

Route::get('/accounts/{uuid}/dashboard', [AccountDashboardController::class, 'show']);
