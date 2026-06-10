<?php
declare(strict_types=1);

$this->layout('AuthLayout', ["title" => "Panel"])
?>

<h1>Welcome, <?= htmlspecialchars((string) $userfront, ENT_QUOTES, 'UTF-8') ?></h1>

<?php if (isLogged() && hasRole('admin')): ?>
    <p><strong>Modo Administrador:</strong> Podés crear, editar y eliminar items.</p>
<?php endif; ?>