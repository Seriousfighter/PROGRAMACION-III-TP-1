<?php

declare(strict_types=1);

namespace App\Routes;

use App\Controllers\IngredientsController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\PanelController;
use App\Controllers\CoberturaController;
use App\Controllers\RellenoController;
use App\Controllers\TamanoController;
use App\Controllers\SaborController;
use App\Controllers\TortaController;

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
$router->post('/coberturas/{id:number}', [CoberturaController::class, 'update']); // ← POST en vez de PUT
$router->delete('/coberturas/{id:number}', [CoberturaController::class, 'destroy']);


//rellenos


// Rellenos
$router->get('/rellenos', [RellenoController::class, 'index']);
$router->get('/rellenos/create', [RellenoController::class, 'create']);
$router->post('/rellenos', [RellenoController::class, 'store']);
$router->get('/rellenos/{id:number}', [RellenoController::class, 'show']);
$router->get('/rellenos/{id:number}/edit', [RellenoController::class, 'edit']);
$router->put('/rellenos/{id:number}', [RellenoController::class, 'update']);
$router->delete('/rellenos/{id:number}', [RellenoController::class, 'destroy']);

// Tamaños
$router->get('/tamanos', [TamanoController::class, 'index']);
$router->get('/tamanos/create', [TamanoController::class, 'create']);
$router->post('/tamanos', [TamanoController::class, 'store']);
$router->get('/tamanos/{id:number}', [TamanoController::class, 'show']);
$router->get('/tamanos/{id:number}/edit', [TamanoController::class, 'edit']);
$router->post('/tamanos/{id:number}', [TamanoController::class, 'update']);
$router->delete('/tamanos/{id:number}', [TamanoController::class, 'destroy']);

// Sabores
$router->get('/sabores', [SaborController::class, 'index']);
$router->get('/sabores/create', [SaborController::class, 'create']);
$router->post('/sabores', [SaborController::class, 'store']);
$router->get('/sabores/{id:number}', [SaborController::class, 'show']);
$router->get('/sabores/{id:number}/edit', [SaborController::class, 'edit']);
$router->post('/sabores/{id:number}', [SaborController::class, 'update']);
$router->delete('/sabores/{id:number}', [SaborController::class, 'destroy']);


// Tortas
// Rutas GET (mostrar formularios y listados)
$router->get('/tortas', [TortaController::class, 'index']);
$router->get('/tortas/create', [TortaController::class, 'create']);      // ← FORM NUEVA
$router->get('/tortas/{id}', [TortaController::class, 'show']);
$router->get('/tortas/{id}/edit', [TortaController::class, 'edit']);      // ← FORM EDITAR

// Rutas POST (guardar)
$router->post('/tortas/store', [TortaController::class, 'store']);        // ← GUARDAR NUEVA
$router->post('/tortas/{id}/update', [TortaController::class, 'update']); // ← GUARDAR EDICIÓN
$router->post('/tortas/{id}/delete', [TortaController::class, 'destroy']); // ← ELIMINAR