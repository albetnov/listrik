<?php

namespace Albet\Asmvc\Controllers;

use Albet\Asmvc\Core\Flash;
use Albet\Asmvc\Core\Requests;
use Albet\Asmvc\Core\SessionManager;
use Albet\Asmvc\Core\Validator;
use Albet\Asmvc\Models\Admin;

class AuthController
{
    public function login()
    {
        return view('Auth.login');
    }

    public function auth()
    {
        $validate = Validator::make([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username:required' => 'Isi ya manis...',
            'password:required' => 'ISI WOI'
        ]);
        if (!$validate) {
            return redirect('/');
        }

        $find = Admin::with('level')->where('username', request()->input('username'))->first();
        if ($find) {
            if (!passCompare(request()->input('password'), $find->password)) {
                Flash::flash('error', 'Kresidensial tidak cocok');
                return redirect('/');
            }
            if ($find->level->nama_level == 'admin') {
                $_SESSION['logged'] = true;
                $_SESSION['id'] = $find->id_admin;
                return redirect('/admin/dashboard');
            }
        } else {
            Flash::flash('error', 'Kresidensial tidak cocok');
            return redirect('/');
        }
    }

    public function vDaftar()
    {
        return view('Auth.register');
    }

    public function daftar()
    {
        $requests = new Requests;
        $validate = Validator::make([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required|min:8',
            'conpass' => 'required|same:password',
        ], [
            'nama:required' => 'Gak punya nama kah?',
            'username:required' => 'Nama panggilan? masa ga ada juga?',
            'password:required' => 'Kasih lah password. Mau buat akun atau apa?',
            'password:min' => 'Nih password pendek amat. Tar di hack nangis.',
            'conpass:required' => 'Isi juga ini oi',
            'conpass:same' => 'Samain dong bambang sama password lu',
        ]);

        if (!$validate) {
            return redirect('/register', false);
        }

        Admin::create([
            'nama_admin' => $requests->input('nama'),
            'username' => $requests->input('username'),
            'password' => mkPass(PASSWORD_BCRYPT, $requests->input('password')),
            'id_level' => 3
        ]);

        Flash::flash('pesan', 'Account created sucessfully!');
        return redirect('/', false);
    }

    public static function redirect()
    {
        if (isset($_SESSION['level']) && Admin::user()->level->nama_level == 'admin') {
            return redirect('/admin/dashboard');
        }
    }

    public function logout()
    {
        unset($_SESSION['id']);
        unset($_SESSION['logged']);
        SessionManager::generateSession(true);
        return redirect('/', false);
    }
}
