<?php

declare(strict_types=1);

namespace App\Controllers;

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
    }
}