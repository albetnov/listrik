<?php

use Albet\Asmvc\Controllers\BankController;
use Albet\Asmvc\Controllers\LaporanController;
use Albet\Asmvc\Core\Route;
use Albet\Asmvc\Middleware\Bank;

Route::add('/bank/dashboard', [BankController::class, 'index'], Bank::class);

Route::add('/bank/laporan', [LaporanController::class, 'index'], Bank::class);
