<?php

declare(strict_types=1);

namespace App\Controllers;
use App\Entities\User;
use Framework\Controller\AbstractController;
use Psr\Http\Message\ServerRequestInterface;

// todo lo de Auth controller se podria sacar y hacer interface para poder cambiar el sistema de autenticacion facilmente,
 // pero por ahora lo dejo asi para no complicar mas el TP, pero es algo a tener en cuenta para proyectos mas grandes, 
// y tambien se podria usar un middleware para proteger las rutas que necesiten autenticacion.
class AuthController extends AbstractController
{
    public function showLogin() {
        return $this->render('Auth/login'); 
    }
    public function showRegister() {
        return $this->render('Auth/register'); 
    } 
    public function login(ServerRequestInterface $request) { 
        $data = $request->getParsedBody() ?? []; 
        $email = trim((string)($data['email'] ?? '')); 
        $password = (string)($data['password'] ?? ''); 
        $user = User::where('email', $email)->first(); 
        if (!$user || !password_verify($password, $user->password)) { 
            return $this->render('Auth/login', ['error' => 'Credenciales inválidas'], 401); 
        } 
        $_SESSION['user'] = [ 
            'id' => $user->id, 
            'name' => $user->name, 
            'email' => $user->email, 
            'role' => $user->role, 
        ]; 
        return $this->redirect('/panel'); 
    } 
    public function register(ServerRequestInterface $request) {
        $data = $request->getParsedBody() ?? [];
        $name = trim((string)($data['name'] ?? ''));
        $email = trim((string)($data['email'] ?? ''));
        $password = (string)($data['password'] ?? '');

        if ($name === '' || $email === '' || $password === '') {
            return $this->render('Auth/register', ['error' => 'Completa todos los campos'], 422);
        }

        if (User::where('email', $email)->exists()) {
            return $this->render('Auth/register', ['error' => 'El email ya está registrado'], 409);
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'cliente',
        ]);

        $_SESSION['user'] = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ];

        return $this->redirect('/panel');
    }
    public function logout() { 
        unset($_SESSION['user']); 
        return $this->redirect('/login'); 
    }
}