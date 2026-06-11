<?php

declare(strict_types=1);

namespace App\Controllers;

<<<<<<< HEAD
use App\Framework\DB;

class TortaController
{
    private DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    // Muestra el formulario
    public function crear()
    {
        $usuarios = $this->db->fetchAll("SELECT id, nombre, email FROM usuarios");
        $sabores = $this->db->fetchAll("SELECT * FROM sabores");
        $rellenos = $this->db->fetchAll("SELECT * FROM rellenos");
        $coberturas = $this->db->fetchAll("SELECT * FROM coberturas");
        $tamanos = $this->db->fetchAll("SELECT * FROM tamanos");
        
        return view('tortas/crear', [
            'usuarios' => $usuarios,
            'sabores' => $sabores,
            'rellenos' => $rellenos,
            'coberturas' => $coberturas,
            'tamanos' => $tamanos
        ]);
    }

    // Guarda el pedido y la torta
    public function guardar()
    {
        $usuario_id = $_POST['usuario_id'];
        $sabor_id = $_POST['sabor_id'];
        $cobertura_id = $_POST['cobertura_id'] ?? null;
        $tamano_id = $_POST['tamano_id'];
        $fecha_entrega = $_POST['fecha_entrega'] ?? null;
        
        // Obtener precio del tamaño
        $tamano = $this->db->fetchOne("SELECT precio FROM tamanos WHERE id = ?", [$tamano_id]);
        $total = $tamano['precio'] ?? 0;
        
        // 1. Insertar pedido
        $this->db->execute(
            "INSERT INTO pedidos (usuario_id, fecha_pedido, fecha_entrega, total, estado) 
             VALUES (?, CURDATE(), ?, ?, 'pendiente')",
            [$usuario_id, $fecha_entrega, $total]
        );
        $pedido_id = $this->db->lastInsertId();
        
        // 2. Insertar torta
        $this->db->execute(
            "INSERT INTO tortas (pedido_id, sabor_id, cobertura_id, tamanho_id, precio_unitario) 
             VALUES (?, ?, ?, ?, ?)",
            [$pedido_id, $sabor_id, $cobertura_id, $tamano_id, $total]
        );
        $torta_id = $this->db->lastInsertId();
        
        // 3. Insertar rellenos (tabla tortas_rellenos)
        if (!empty($_POST['rellenos_id'])) {
            foreach ($_POST['rellenos_id'] as $relleno_id) {
                $this->db->execute(
                    "INSERT INTO tortas_rellenos (torta_id, relleno_id) VALUES (?, ?)",
                    [$torta_id, $relleno_id]
                );
            }
        }
        
        header('Location: /pedidos');
        exit;
=======
use App\Entities\Torta;
use App\Entities\Sabor;
use App\Entities\Cobertura;
use App\Entities\Tamano;
use App\Entities\Relleno;
use Framework\Controller\AbstractController;
use Psr\Http\Message\ServerRequestInterface;

class TortaController extends AbstractController
{

    public function index()
    {
        $tortas = Torta::with(['sabor', 'cobertura', 'tamano', 'rellenos'])->get();
        return $this->render('torta/index', ['tortas' => $tortas]);
    }

    public function show(ServerRequestInterface $request, array $args)
    {
        $torta = Torta::with(['sabor', 'cobertura', 'tamano', 'rellenos'])->find($args['id']);
        
        if ($torta) {
            return $this->render('torta/show', [
                'id' => $torta->id,
                'sabor' => $torta->sabor->nombre ?? 'No encontrado',
                'cobertura' => $torta->cobertura->nombre ?? 'No encontrado',
                'tamano' => $torta->tamano->nombre ?? 'No encontrado',
                'rellenos' => $torta->rellenos,
                'precio_unitario' => $torta->precio_unitario
            ]);
        }
        
        return $this->render('torta/show', [
            'id' => $args['id'],
            'sabor' => 'not found',
            'cobertura' => 'not found',
            'tamano' => 'not found',
            'rellenos' => collect(),
            'precio_unitario' => 0
        ]);
    }

    public function create()
    {
        if (!isLogged()) {
            return $this->render('error', ['message' => 'Debes iniciar sesión', 'status' => '403'], 403);
        }
        
        $sabores = Sabor::all();
        $coberturas = Cobertura::all();
        $tamanos = Tamano::all();
        $rellenos = Relleno::all();
        
        return $this->render('torta/save', [
            'sabores' => $sabores,
            'coberturas' => $coberturas,
            'tamanos' => $tamanos,
            'rellenos' => $rellenos
        ]);
    }

    // ✅ NUEVO: Calcula el precio automáticamente
    private function calcularPrecioUnitario(array $data): float
    {
        $precio = 0.0;

        // Precio base del tamaño
        if (!empty($data['tamano_id'])) {
            $tamano = Tamano::find($data['tamano_id']);
            if ($tamano) {
                $precio += (float) $tamano->precio_base;
            }
        }

        // Extra del sabor
        if (!empty($data['sabor_id'])) {
            $sabor = Sabor::find($data['sabor_id']);
            if ($sabor) {
                $precio += (float) $sabor->precio_extra;
            }
        }

        // Extra de la cobertura
        if (!empty($data['cobertura_id'])) {
            $cobertura = Cobertura::find($data['cobertura_id']);
            if ($cobertura) {
                $precio += (float) $cobertura->precio_extra;
            }
        }

        // Extras de los rellenos
        $rellenosIds = $data['rellenos'] ?? [];
        if (!empty($rellenosIds)) {
            $rellenos = Relleno::whereIn('id', $rellenosIds)->get();
            foreach ($rellenos as $r) {
                $precio += (float) $r->precio_extra;
            }
        }

        return $precio;
    }

    public function store(ServerRequestInterface $request)
    {
        if (!isLogged()) {
            return $this->render('error', ['message' => 'Debes iniciar sesión', 'status' => '403'], 403);
        }
        
        $data = $request->getParsedBody();

        $torta = new Torta();
        $torta->pedido_id = $data['pedido_id'] ?? $this->getCurrentPedidoId();
        $torta->sabor_id = $data['sabor_id'] ?? null;
        $torta->cobertura_id = $data['cobertura_id'] ?? null;
        $torta->tamano_id = $data['tamano_id'] ?? null;
        // ✅ PRECIO CALCULADO AUTOMÁTICAMENTE - el cliente no lo envía
        $torta->precio_unitario = $this->calcularPrecioUnitario($data);
        $torta->save();

        $rellenosIds = $data['rellenos'] ?? [];
        if (!empty($rellenosIds)) {
            $torta->rellenos()->attach($rellenosIds);
        }

        return $this->redirect('/tortas');
    }

    public function edit(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $torta = Torta::with('rellenos')->find($args['id']);
        if (!$torta) {
            return $this->render('error', ['message' => 'Torta no encontrada', 'status' => '404'], 404);
        }
        
        $sabores = Sabor::all();
        $coberturas = Cobertura::all();
        $tamanos = Tamano::all();
        $rellenos = Relleno::all();
        
        $rellenosSeleccionados = $torta->rellenos->pluck('id')->toArray();
        
        return $this->render('torta/save', [
            'torta' => $torta,
            'sabores' => $sabores,
            'coberturas' => $coberturas,
            'tamanos' => $tamanos,
            'rellenos' => $rellenos,
            'rellenosSeleccionados' => $rellenosSeleccionados
        ]);
    }

    public function update(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $torta = Torta::find($args['id']);
        if (!$torta) {
            return $this->render('error', ['message' => 'Torta no encontrada', 'status' => '404'], 404);
        }
        
        $data = $request->getParsedBody();
        $torta->sabor_id = $data['sabor_id'] ?? $torta->sabor_id;
        $torta->cobertura_id = $data['cobertura_id'] ?? $torta->cobertura_id;
        $torta->tamano_id = $data['tamano_id'] ?? $torta->tamano_id;
        // ✅ PRECIO RECALCULADO AUTOMÁTICAMENTE
        $torta->precio_unitario = $this->calcularPrecioUnitario($data);
        $torta->save();

        $rellenosIds = $data['rellenos'] ?? [];
        $torta->rellenos()->sync($rellenosIds);

        return $this->redirect('/tortas');
    }

    public function destroy(ServerRequestInterface $request, array $args)
    {
        if (!isLogged() || !hasRole('admin')) {
            return $this->render('error', ['message' => 'No autorizado', 'status' => '403'], 403);
        }
        
        $torta = Torta::find($args['id']);
        if ($torta) {
            $torta->rellenos()->detach();
            $torta->delete();
        }

        return $this->redirect('/tortas');
    }

    private function getCurrentPedidoId(): int
    {
        return $_SESSION['pedido_id'] ?? 1;
>>>>>>> 584df76d791b10d803b592c89df885ec88d35a5e
    }
}