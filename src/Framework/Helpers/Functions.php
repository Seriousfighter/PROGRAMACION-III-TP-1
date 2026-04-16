<?php

declare(strict_types=1);

//me gusta el dd de laravel
function dd(mixed $data): never
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

// esto iria in la auth y no aca. deamsiado para el tp
function authUser(): ?array
{
    return $_SESSION['user'] ?? null;
}

function isLogged(): bool
{
    return authUser() !== null;
}

function hasRole(string $role): bool
{
    return (authUser()['role'] ?? null) === $role;
}
