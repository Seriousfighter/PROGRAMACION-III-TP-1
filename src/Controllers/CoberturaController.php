<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Cobertura;
use Framework\Controller\AbstractController;
use Psr\Http\Message\ServerRequestInterface;

class CoberturaController extends AbstractController
{

    public function index()
    {
        $coberturas = Cobertura::all();
        return $this->render('cobertura/index', ['coberturas' => $coberturas]);
    }

    public function show(ServerRequestInterface $request, array $args)
    {
        if ($cobertura = Cobertura::find($args['id'])) {
            return $this->render('cobertura/show', [
                'id' => $cobertura->id,
                'nombre' => $cobertura->nombre ?? '',
                'precio_extra' => $cobertura->precio_extra ?? 0
            ]);
        }
        return $this->render('cobertura/show', [
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
        return $this->render('cobertura/save');
    }

    public function store(ServerRequestInterface $request)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $data = $request->getParsedBody();

        $cobertura = new Cobertura();
        $cobertura->nombre = $data['nombre'] ?? '';
        $cobertura->precio_extra = $data['precio_extra'] ?? 0;
        $cobertura->save();

        return $this->redirect('/coberturas');
    }

    public function edit(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $cobertura = Cobertura::find($args['id']);
        if (!$cobertura) {
            return $this->render('error', ['message' => 'Cobertura no encontrada', 'status' => '404'], 404);
        }
        
        return $this->render('cobertura/save', ['cobertura' => $cobertura]);
    }

    public function update(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $cobertura = Cobertura::find($args['id']);
        if (!$cobertura) {
            return $this->render('error', ['message' => 'Cobertura no encontrada', 'status' => '404'], 404);
        }
        
        $data = $request->getParsedBody();
        $cobertura->nombre = $data['nombre'] ?? $cobertura->nombre;
        $cobertura->precio_extra = $data['precio_extra'] ?? $cobertura->precio_extra;
        $cobertura->save();

        return $this->redirect('/coberturas');
    }

    public function destroy(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $cobertura = Cobertura::find($args['id']);
        if ($cobertura) {
            $cobertura->delete();
        }

        return $this->redirect('/coberturas');
    }
}