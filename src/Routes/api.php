<?php

declare(strict_types=1);

namespace App\Routes;

use App\Controllers\ApiController;

$router->get('/api/health', [ApiController::class, 'health']);