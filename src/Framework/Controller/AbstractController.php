<?php

declare(strict_types=1);

namespace Framework\Controller;

use DI\Attribute\Inject;
use Framework\Template\RendererInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractController
{
    
    #[Inject]
    private ResponseFactoryInterface $factory;

    #[Inject]
    private RendererInterface $renderer;
    //podemos poner aqui metodos comunes a todos los controladores, como por ejemplo un metodo para renderizar las vistas, o para redirigir, etc.
    protected function render(string $view, array $data = [], int $status = 200): ResponseInterface
    {
           //$id= $args['id'];
        $content = $this->renderer->render($view, $data);

        $stream =  $this->factory->createStream($content);    

        $response = $this->factory->createResponse($status);

        $response = $response->withBody($stream);

        return $response;
    }

    // metodo para json en las api
    protected function json(array $data, int $status = 200): ResponseInterface
    {
        $content = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        if ($content === false) {
            throw new \RuntimeException('Failed to encode JSON response.');
        }

        $stream = $this->factory->createStream($content);
        $response = $this->factory->createResponse($status);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withBody($stream);
    }

    //redireccion para cualquier caso necesario
    protected function redirect(string $url, int $status = 302): ResponseInterface
    {
        return $this->factory->createResponse($status)
            ->withHeader('Location', $url);
    }
}