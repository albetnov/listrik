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
        } else if (ModelsAdmin::user()->level->nama_level) {
            return AuthController::redirect();
        }
    }
}
