<nav class="navbar">
    <a href="/" class="nav-logo">🍰 Tu Dulce Elección</a>

    <ul class="nav-menu">
        <li><a href="/ingredients">Ingredientes</a></li>
        <li><a href="/coberturas">Coberturas</a></li>
        <li><a href="/rellenos">Rellenos</a></li>
        <li><a href="/tortas/create">🍰 Hacer mi torta</a></li>
        <?php if (!isLogged()): ?>
            <li><a href="/register">Register</a></li>
        <?php endif; ?>
    </ul>
    
    
</nav>