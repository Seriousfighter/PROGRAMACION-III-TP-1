<?php

declare(strict_types=1);

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Relleno extends Model
{
    public $timestamps = false;
    protected $table = 'rellenos';
    protected $fillable = ['nombre', 'precio_extra'];
}