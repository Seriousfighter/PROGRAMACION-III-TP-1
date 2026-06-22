<nav class="navbar">
    <ul class="nav-menu">
        <?php if (isLogged() && hasRole('admin')): ?>
            <li><a href="/ingredients/create">Crear Ingrediente</a></li>
            <li><a href="/pedidos">Ver Pedidos</a></li>
        <?php endif; ?>
    </ul>
</nav>