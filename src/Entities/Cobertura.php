<?php

declare(strict_types=1);

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Cobertura extends Model
{
    public $timestamps = false; // Si no quieres campos created_at y updated_at
    protected $table = 'coberturas'; // no es necesario si seguimos la convención de nombres
    protected $fillable = ['nombre', 'precio_extra'];
}