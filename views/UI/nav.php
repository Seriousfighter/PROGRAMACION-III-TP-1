<nav>
    <a href="/">Home</a>
    <a href="/ingredients">Ingredientes</a>
    <a href="/coberturas">Coberturas</a>
    <a href="/rellenos">Rellenos</a>
    
    <?php if (!isLogged()): ?>
        <a href="/register">Register</a>
    <?php endif; ?>
</nav>