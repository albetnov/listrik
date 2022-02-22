<?php

use Albet\Asmvc\Controllers\PelangganController;
use Albet\Asmvc\Core\Route;
use Albet\Asmvc\Middleware\Pelanggan;
use Albet\Asmvc\Controllers\PembayaranController;

Route::add('/pelanggan/dashboard', [PelangganController::class, 'index'], Pelanggan::class);

//Pembayaran
Route::add('/pelanggan/pembayaran', [PembayaranController::class, 'index'], Pelanggan::class);
Route::add('/pelanggan/pembayaran/buat', [PembayaranController::class, 'buat'], Pelanggan::class);
Route::add('/pelanggan/pembayaran/aksi_buat', [PembayaranController::class, 'prosesBuat'], 'POST', Pelanggan::class);
Route::add('/pelanggan/pembayaran/see/' . Route::PARAMETER, [PembayaranController::class, 'seeDetail'], Pelanggan::class);
Route::add('/pelanggan/pembayaran/edit/' . Route::PARAMETER, [PembayaranController::class, 'edit'], Pelanggan::class);
Route::add('/pelanggan/pembayaran/aksi_edit/' . Route::PARAMETER, [PembayaranController::class, 'prosesEdit'], 'POST', Pelanggan::class);
Route::add('/pelanggan/pembayaran/delete/' . Route::PARAMETER, [PembayaranController::class, 'delete'], 'POST', Pelanggan::class);
