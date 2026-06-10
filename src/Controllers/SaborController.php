<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Sabor;
use Framework\Controller\AbstractController;
use Psr\Http\Message\ServerRequestInterface;

class SaborController extends AbstractController
{

    public function index()
    {
        $sabores = Sabor::all();
        return $this->render('sabor/index', ['sabores' => $sabores]);
    }

    public function show(ServerRequestInterface $request, array $args)
    {
        if ($sabor = Sabor::find($args['id'])) {
            return $this->render('sabor/show', [
                'id' => $sabor->id,
                'nombre' => $sabor->nombre ?? '',
                'precio_extra' => $sabor->precio_extra ?? 0
            ]);
        }
        return $this->render('sabor/show', [
            'id' => $args['id'],
            'nombre' => 'not found',
            'precio_extra' => 0
        ]);
    }

    public function create()
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        return $this->render('sabor/save');
    }

    public function store(ServerRequestInterface $request)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $data = $request->getParsedBody();

        $sabor = new Sabor();
        $sabor->nombre = $data['nombre'] ?? '';
        $sabor->precio_extra = $data['precio_extra'] ?? 0;
        $sabor->save();

        return $this->redirect('/sabores');
    }

    public function edit(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $sabor = Sabor::find($args['id']);
        if (!$sabor) {
            return $this->render('error', ['message' => 'Sabor no encontrado', 'status' => '404'], 404);
        }
        
        return $this->render('sabor/save', ['sabor' => $sabor]);
    }

    public function update(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $sabor = Sabor::find($args['id']);
        if (!$sabor) {
            return $this->render('error', ['message' => 'Sabor no encontrado', 'status' => '404'], 404);
        }
        
        $data = $request->getParsedBody();
        $sabor->nombre = $data['nombre'] ?? $sabor->nombre;
        $sabor->precio_extra = $data['precio_extra'] ?? $sabor->precio_extra;
        $sabor->save();

        return $this->redirect('/sabores');
    }

    public function destroy(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $sabor = Sabor::find($args['id']);
        if ($sabor) {
            $sabor->delete();
        }

        return $this->redirect('/sabores');
    }
}