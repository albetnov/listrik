<?php

namespace Albet\Asmvc\Controllers;

use Albet\Asmvc\Core\Requests;
use Albet\Asmvc\Models\Admin;

class BankController
{
    public function index()
    {
        return view('Bank.dashboard', [
            'nama' => Admin::user()->nama_admin,
        ]);
    }
}
