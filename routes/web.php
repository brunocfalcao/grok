<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Nidavellir\Grok\Controllers\AccountDashboardController;
use Nidavellir\Thor\Models\System;
use Nidavellir\Thor\Models\User;

Route::get('/', function () {
    return view('grok::welcome');
});
