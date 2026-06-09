<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Tamano;
use Framework\Controller\AbstractController;
use Psr\Http\Message\ServerRequestInterface;

class TamanoController extends AbstractController
{

    public function index()
    {
        $tamanos = Tamano::all();
        return $this->render('tamano/index', ['tamanos' => $tamanos]);
    }

    public function show(ServerRequestInterface $request, array $args)
    {
        if ($tamano = Tamano::find($args['id'])) {
            return $this->render('tamano/show', [
                'id' => $tamano->id,
                'nombre' => $tamano->nombre ?? '',
                'porciones' => $tamano->porciones ?? 0,
                'precio_base' => $tamano->precio_base ?? 0
            ]);
        }
        return $this->render('tamano/show', [
            'id' => $args['id'],
            'nombre' => 'not found',
            'porciones' => 0,
            'precio_base' => 0
        ]);
    }

    public function create()
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        return $this->render('tamano/save');
    }

    public function store(ServerRequestInterface $request)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $data = $request->getParsedBody();

        $tamano = new Tamano();
        $tamano->nombre = $data['nombre'] ?? '';
        $tamano->porciones = $data['porciones'] ?? 0;
        $tamano->precio_base = $data['precio_base'] ?? 0;
        $tamano->save();

        return $this->redirect('/tamanos');
    }

    public function edit(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $tamano = Tamano::find($args['id']);
        if (!$tamano) {
            return $this->render('error', ['message' => 'Tamaño no encontrado', 'status' => '404'], 404);
        }
        
        return $this->render('tamano/save', ['tamano' => $tamano]);
    }

    public function update(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $tamano = Tamano::find($args['id']);
        if (!$tamano) {
            return $this->render('error', ['message' => 'Tamaño no encontrado', 'status' => '404'], 404);
        }
        
        $data = $request->getParsedBody();
        $tamano->nombre = $data['nombre'] ?? $tamano->nombre;
        $tamano->porciones = $data['porciones'] ?? $tamano->porciones;
        $tamano->precio_base = $data['precio_base'] ?? $tamano->precio_base;
        $tamano->save();

        return $this->redirect('/tamanos');
    }

    public function destroy(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $tamano = Tamano::find($args['id']);
        if ($tamano) {
            $tamano->delete();
        }

        return $this->redirect('/tamanos');
    }
}