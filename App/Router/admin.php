<?php

use Albet\Asmvc\Core\Route;
use Albet\Asmvc\Controllers\AdminController;
use Albet\Asmvc\Middleware\Admin;

Route::add('/admin/dashboard', [AdminController::class, 'index'], Admin::class);
Route::add('/admin/akun', [AdminController::class, 'akun'], Admin::class);
Route::add('/admin/akun/buat', [AdminController::class, 'vBuatAkun'], Admin::class);
Route::add('/admin/akun/aksi_buat', [AdminController::class, 'buatAkun'], 'POST', Admin::class);
Route::add("/admin/akun/edit/" . Route::PARAMETER, [AdminController::class, 'vEditAkun'], Admin::class);
Route::add('/admin/akun/aksi_edit/' . Route::PARAMETER, [AdminController::class, 'editAkun'], 'POST', Admin::class);
Route::add('/admin/akun/delete/' . Route::PARAMETER, [AdminController::class, 'delAkun'], 'POST', Admin::class);
Route::add('/admin/pelanggan', [AdminController::class, 'pelanggan'], Admin::class);
Route::add('/admin/pelanggan/buat', [AdminController::class, 'vAddPelanggan'], Admin::class);
Route::add('/admin/pelanggan/aksi_buat', [AdminController::class, 'addPelanggan'], 'POST', Admin::class);
Route::add('/admin/pelanggan/edit/' . Route::PARAMETER, [AdminController::class, 'vEditPelanggan'], Admin::class);
Route::add('/admin/pelanggan/aksi_edit/' . Route::PARAMETER, [AdminController::class, 'editPelanggan'], 'POST', Admin::class);
Route::add('/admin/pelanggan/delete/' . Route::PARAMETER, [AdminController::class, 'delPelanggan'], 'POST', Admin::class);
Route::add('/admin/tarif', [AdminController::class, 'tarif'], Admin::class);
Route::add('/admin/tarif/buat', [AdminController::class, 'vAddTarif'], Admin::class);
Route::add('/admin/tarif/aksi_buat', [AdminController::class, 'addTarif'], 'POST', Admin::class);
Route::add('/admin/tarif/edit/' . Route::PARAMETER, [AdminController::class, 'vEditTarif'], Admin::class);
Route::add('/admin/tarif/aksi_edit/' . Route::PARAMETER, [AdminController::class, 'editTarif'], 'POST', Admin::class);
Route::add('/admin/tarif/delete/' . Route::PARAMETER, [AdminController::class, 'delTarif'], 'POST', Admin::class);
Route::add('/admin/pengunaan', [AdminController::class, 'pengunaan'], Admin::class);
Route::add('/admin/pengunaan/buat', [AdminController::class, 'vAddPengunaan'], Admin::class);
Route::add('/admin/pengunaan/aksi_buat', [AdminController::class, 'addPengunaan'], 'POST', Admin::class);
Route::add('/admin/pengunaan/edit/' . Route::PARAMETER, [AdminController::class, 'vEditPengunaan'], Admin::class);
Route::add('/admin/pengunaan/aksi_edit/' . Route::PARAMETER, [AdminController::class, 'editPengunaan'], 'POST', Admin::class);
Route::add('/admin/pengunaan/delete/' . Route::PARAMETER, [AdminController::class, 'delPengunaan'], 'POST', Admin::class);
