<nav>
    <?php if (isLogged() && hasRole('admin')): ?>
        <a href="/ingredients/create">Crear Ingrediente</a>
        <a href="/pedidos">Ver Pedidos</a>
    <?php endif; ?>
</nav>