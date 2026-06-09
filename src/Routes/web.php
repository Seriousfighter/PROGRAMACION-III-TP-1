<?php

declare(strict_types=1);

namespace App\Routes;

use App\Controllers\IngredientsController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\PanelController;
use App\Controllers\CoberturaController;

//login register
$router->get('/login', [AuthController::class, 'showLogin']); //falta implementar el login, pero es solo para mostrar como se haria, no es necesario para el TP
$router->get('/register', [AuthController::class, 'showRegister']); //falta implementar el register, pero es solo para mostrar como se haria, no es necesario para el TP
$router->post('/login', [AuthController::class, 'login']); //falta implementar el login, pero es solo para mostrar como se haria, no es necesario para el TP
$router->post('/register', [AuthController::class, 'register']); //falta
$router->post('/logout', [AuthController::class, 'logout']); //falta implementar el logout, pero es solo para mostrar como se haria, no es necesario para el TP

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']); //ejemplo, no es necesario para el TP, pero es para mostrar como se haria con un controlador, se pueden usar funciones anonimas tambien
$router->get('/contact', [HomeController::class, 'contact']); //ejemplo

$router->get('/panel', [PanelController::class, 'panel']); //ejemplo

$router->get('/ingredients', [IngredientsController::class, 'index']);
$router->get('/ingredients/create', [IngredientsController::class, 'create']);
$router->post('/ingredients', [IngredientsController::class, 'store']);
$router->get('/ingredients/{id:number}', [IngredientsController::class, 'show']);
$router->put('/ingredients/{id:number}', [IngredientsController::class, 'update']); //faltan
$router->delete('/ingredients/{id:number}', [IngredientsController::class, 'destroy']); //faltan

// Coberturas
$router->get('/coberturas', [CoberturaController::class, 'index']);
$router->get('/coberturas/create', [CoberturaController::class, 'create']);
$router->post('/coberturas', [CoberturaController::class, 'store']);
$router->get('/coberturas/{id:number}', [CoberturaController::class, 'show']);
$router->get('/coberturas/{id:number}/edit', [CoberturaController::class, 'edit']);
$router->put('/coberturas/{id:number}', [CoberturaController::class, 'update']);
$router->delete('/coberturas/{id:number}', [CoberturaController::class, 'destroy']);

//rellenos
use App\Controllers\RellenoController;

// Rellenos
$router->get('/rellenos', [RellenoController::class, 'index']);
$router->get('/rellenos/create', [RellenoController::class, 'create']);
$router->post('/rellenos', [RellenoController::class, 'store']);
$router->get('/rellenos/{id:number}', [RellenoController::class, 'show']);
$router->get('/rellenos/{id:number}/edit', [RellenoController::class, 'edit']);
$router->put('/rellenos/{id:number}', [RellenoController::class, 'update']);
$router->delete('/rellenos/{id:number}', [RellenoController::class, 'destroy']);