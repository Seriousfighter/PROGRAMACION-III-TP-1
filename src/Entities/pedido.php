<?php

declare(strict_types=1);

namespace App\Entities;

class Pedido
{
    private ?int $id;
    private string $cliente;
    private string $producto;
    private int $cantidad;
    private string $fecha;
    private string $estado;

    public function __construct(
        ?int $id = null,
        string $cliente = '',
        string $producto = '',
        int $cantidad = 0,
        string $fecha = '',
        string $estado = 'pendiente'
    ) {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->producto = $producto;
        $this->cantidad = $cantidad;
        $this->fecha = $fecha;
        $this->estado = $estado;
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getCliente(): string { return $this->cliente; }
    public function getProducto(): string { return $this->producto; }
    public function getCantidad(): int { return $this->cantidad; }
    public function getFecha(): string { return $this->fecha; }
    public function getEstado(): string { return $this->estado; }

    // Setters
    public function setCliente(string $cliente): void { $this->cliente = $cliente; }
    public function setProducto(string $producto): void { $this->producto = $producto; }
    public function setCantidad(int $cantidad): void { $this->cantidad = $cantidad; }
    public function setFecha(string $fecha): void { $this->fecha = $fecha; }
    public function setEstado(string $estado): void { $this->estado = $estado; }
}