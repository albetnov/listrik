<?php

namespace Albet\Asmvc\Controllers;

use Albet\Asmvc\Models\Admin;
use Albet\Asmvc\Models\Pelanggan;
use Albet\Asmvc\Models\Pembayaran;
use Albet\Asmvc\Models\Pengunaan;
use Albet\Asmvc\Models\Tagihan;
use Albet\Asmvc\Models\Tarif;

class LaporanController
{
    public function index()
    {
        $data = [
            'user' => Admin::count(),
            'customer' => Pelanggan::count(),
            'price' => Tarif::count(),
            'usage' => Pengunaan::count(),
            'bill' => Tagihan::count(),
            'payment' => Pembayaran::count()
        ];
        return view('Global.laporan.index', $data);
    }
}
