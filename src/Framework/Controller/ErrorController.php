<?php

declare(strict_types=1);

namespace Framework\Controller;

use Framework\Controller\AbstractController;
use Psr\Http\Message\ResponseInterface;

class ErrorController extends AbstractController
{
    public function notFound(): ResponseInterface
    {
        return $this->errorResponse(404, 'Not Found');
    }

    public function methodNotAllowed(): ResponseInterface
    {
        return $this->errorResponse(405, 'Method Not Allowed');
    }

    public function serverError(): ResponseInterface
    {
        return $this->errorResponse(500, 'Internal Server Error');
    }

    private function errorResponse(int $status, string $message): ResponseInterface
    {
        return $this->render('error', [
            'status' => $status,
            'message' => $message,
        ], $status);
    }
}