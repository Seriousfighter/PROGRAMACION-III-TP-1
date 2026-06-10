<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Relleno;
use Framework\Controller\AbstractController;
use Psr\Http\Message\ServerRequestInterface;

class RellenoController extends AbstractController
{

    public function index()
    {
        $rellenos = Relleno::all();
        return $this->render('relleno/index', ['rellenos' => $rellenos]);
    }

    public function show(ServerRequestInterface $request, array $args)
    {
        if ($relleno = Relleno::find($args['id'])) {
            return $this->render('relleno/show', [
                'id' => $relleno->id,
                'nombre' => $relleno->nombre ?? '',
                'precio_extra' => $relleno->precio_extra ?? 0
            ]);
        }
        return $this->render('relleno/show', [
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
        return $this->render('relleno/save');
    }

    public function store(ServerRequestInterface $request)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $data = $request->getParsedBody();

        $relleno = new Relleno();
        $relleno->nombre = $data['nombre'] ?? '';
        $relleno->precio_extra = $data['precio_extra'] ?? 0;
        $relleno->save();

        return $this->redirect('/rellenos');
    }

    public function edit(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $relleno = Relleno::find($args['id']);
        if (!$relleno) {
            return $this->render('error', ['message' => 'Relleno no encontrado', 'status' => '404'], 404);
        }
        
        return $this->render('relleno/save', ['relleno' => $relleno]);
    }

    public function update(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $relleno = Relleno::find($args['id']);
        if (!$relleno) {
            return $this->render('error', ['message' => 'Relleno no encontrado', 'status' => '404'], 404);
        }
        
        $data = $request->getParsedBody();
        $relleno->nombre = $data['nombre'] ?? $relleno->nombre;
        $relleno->precio_extra = $data['precio_extra'] ?? $relleno->precio_extra;
        $relleno->save();

        return $this->redirect('/rellenos');
    }

    public function destroy(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $relleno = Relleno::find($args['id']);
        if ($relleno) {
            $relleno->delete();
        }

        return $this->redirect('/rellenos');
    }
}