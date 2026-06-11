<?php

declare(strict_types=1);

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Tamano extends Model
{
    public $timestamps = false;
    protected $table = 'tamanos';
    protected $fillable = ['nombre', 'porciones', 'precio_base'];
}