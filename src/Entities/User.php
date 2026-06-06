<?php

declare(strict_types=1);

Namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'role'];
    protected $hidden = ['password'];
}   