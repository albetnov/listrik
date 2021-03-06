<?php

namespace Albet\Asmvc\Middleware;

use Albet\Asmvc\Controllers\AuthController;
use Albet\Asmvc\Core\BaseMiddleware;
use Albet\Asmvc\Models\Admin as ModelsAdmin;

class Admin extends BaseMiddleware
{
    public function middleware()
    {
        if (!isset($_SESSION['logged'])) {
            return redirect('/');
        } else if (!isset(ModelsAdmin::user()->level->nama_level) || ModelsAdmin::user()->level->nama_level != 'admin') {
            return AuthController::redirect();
        }
    }
}
