<?php

namespace Albet\Asmvc\Controllers;

use Albet\Asmvc\Core\Requests;
use Albet\Asmvc\Models\Admin;

class PelangganController
{
    public function index()
    {
        return view('Pelanggan.dashboard', [
            'nama' => Admin::user()->nama_pelanggan,
        ]);
    }
}
