<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\Controller\AbstractController;
use Psr\Http\Message\ResponseInterface;

class ApiController extends AbstractController
{
    public function health(): ResponseInterface
    {
        return $this->json([
            'message' => 'API is healthy',
            'status' => 'ok',
        ]);
    }
}