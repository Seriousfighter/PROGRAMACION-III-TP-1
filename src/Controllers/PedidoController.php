<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Framework\DB;

class PedidoController
{
    private DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function index()
    {
        $pedidos = $this->db->fetchAll("
            SELECT p.*, u.nombre as cliente_nombre 
            FROM pedidos p
            LEFT JOIN usuarios u ON p.usuario_id = u.id
            ORDER BY p.fecha_pedido DESC
        ");
        
        return view('pedidos/index', [
            'pedidos' => $pedidos,
            'titulo' => 'Listado de Pedidos'
        ]);
    }
}