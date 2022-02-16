<?php

namespace Albet\Asmvc\Controllers;

use Albet\Asmvc\Core\Flash;
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
