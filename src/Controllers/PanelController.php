<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\AuthController;

class PanelController extends AuthController
{
    public function panel()
    {
        if (!isLogged()) {
            return $this->render('error', ['message' => 'No autorizado','status'=>'403'], 403);
        }
        $user = $_SESSION['user'] ?? null;
        $user= $user['name'];
        return $this->render('panel', ['user' => $user]);
    }
}

