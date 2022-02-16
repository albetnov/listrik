<?php

namespace Albet\Asmvc\Middleware;

use Albet\Asmvc\Controllers\AuthController;
use Albet\Asmvc\Core\BaseMiddleware;

class Guest extends BaseMiddleware
{
    public function middleware()
    {
        if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
            return AuthController::redirect();
        }
    }
}
