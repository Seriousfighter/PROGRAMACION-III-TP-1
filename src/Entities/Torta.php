<?php

declare(strict_types=1);

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Torta extends Model
{
    public $timestamps = false;
    protected $table = 'tortas';
    protected $fillable = ['pedido_id', 'sabor_id', 'cobertura_id', 'tamano_id', 'precio_unitario'];

    // Relaciones
    public function sabor()
    {
        return $this->belongsTo(Sabor::class, 'sabor_id');
    }

    public function cobertura()
    {
        return $this->belongsTo(Cobertura::class, 'cobertura_id');
    }

    public function tamano()
    {
        return $this->belongsTo(Tamano::class, 'tamano_id');
    }

    // ✅ NUEVA: Relación muchos-a-muchos con rellenos
    public function rellenos()
    {
        return $this->belongsToMany(Relleno::class, 'tortas_rellenos', 'torta_id', 'relleno_id');
    }
}