<?php

namespace Albet\Asmvc\Middleware;

use Albet\Asmvc\Controllers\AuthController;
use Albet\Asmvc\Core\BaseMiddleware;
use Albet\Asmvc\Models\Admin;

class Bank extends BaseMiddleware
{
    public function middleware()
    {
        if (!isset($_SESSION['logged'])) {
            return redirect('/');
        } else if (!isset(Admin::user()->level->nama_level) || Admin::user()->level->nama_level != 'bank') {
            return AuthController::redirect();
        }
    }
}
