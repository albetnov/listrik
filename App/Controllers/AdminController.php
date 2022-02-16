<?php

namespace Albet\Asmvc\Controllers;

use Albet\Asmvc\Core\Flash;
use Albet\Asmvc\Core\Requests;
use Albet\Asmvc\Core\Validator;
use Albet\Asmvc\Models\Admin;
use Albet\Asmvc\Models\Level;

class AdminController
{
    public function index()
    {
        return view('Admin.dashboard', [
            'nama' => Admin::user()->nama_admin,
            'level' => Admin::user()->level->nama_level
        ]);
    }

    public function akun()
    {
        return view('Admin.akun.index', [
            'accounts' => Admin::with('level')->get()
        ]);
    }

    public function vBuatAkun()
    {
        return view('Admin.akun.create', [
            'levels' => Level::get()
        ]);
    }

    public function buatAkun(Requests $requests)
    {
        $validate = Validator::make([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required|min:8',
            'conpass' => 'required|same:password',
            'level' => 'required'
        ], [
            'nama:required' => 'Gak punya nama kah?',
            'username:required' => 'Nama panggilan? masa ga ada juga?',
            'password:required' => 'Kasih lah password. Mau buat akun atau apa?',
            'password:min' => 'Nih password pendek amat. Tar di hack nangis.',
            'conpass:required' => 'Isi juga ini oi',
            'conpass:same' => 'Samain dong bambang sama password lu',
            'level:required' => 'Kalau ga lu kasih level. Gimana caranya gw indentifikasi akun lu?'
        ]);

        if (!$validate) {
            return redirect('/admin/akun/buat', false);
        }

        Admin::create([
            'nama_admin' => $requests->input('nama'),
            'username' => $requests->input('username'),
            'password' => mkPass(PASSWORD_BCRYPT, $requests->input('password')),
            'id_level' => $requests->input('level')
        ]);

        Flash::flash('pesan', 'Account created successfully!');

        return redirect('/admin/akun', false);
    }
}
