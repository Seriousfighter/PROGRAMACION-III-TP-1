<nav>
    <a href="/">Home</a>
    <a href="/ingredients">Ingredientes</a>
    <?= isLogged() ? '<a href="/panel">Panel</a>
    <form method="POST" action="/logout" style="display:inline;">
    <button type="submit">Logout</button></form>' : '<a href="/login">Login</a>
    <a href="/register">Register</a>' ?>
    
    
</nav>