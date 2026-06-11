<?php

declare(strict_types=1);

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Relleno extends Model
{
    public $timestamps = false;
    protected $table = 'rellenos';
    protected $fillable = ['nombre', 'precio_extra'];

    // ✅ Opcional: relación inversa
    public function tortas()
    {
        return $this->belongsToMany(Torta::class, 'tortas_rellenos', 'relleno_id', 'torta_id');
    }
}