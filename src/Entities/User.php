<?php

declare(strict_types=1);

Namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
    public $timestamps = false;
    protected $table = 'usuarios';
    protected $fillable = ['nombre', 'email', 'contrasena_hash', 'rol'];
    protected $hidden = ['password'];
}   