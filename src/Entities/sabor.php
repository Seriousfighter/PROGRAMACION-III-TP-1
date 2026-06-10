<?php

declare(strict_types=1);

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Sabor extends Model
{
    public $timestamps = false;
    protected $table = 'sabores';
    protected $fillable = ['nombre', 'precio_extra'];
}