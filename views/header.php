<<<<<<< HEAD
<body>
    <div>
        <h1>Header</h1>
        <?php include dirname(__DIR__) . '/views/UI/nav.php'; ?>
    </div>
=======
<header>
    <h1>Header</h1>
    <nav>
        <a href="/panel">Panel</a>
        <a href="/rellenos">Rellenos</a>
        <a href="/coberturas">Coberturas</a>
        <a href="/tamanos">Tamaños</a>
        <a href="/sabores">Sabores</a>
        <a href="/tortas">Tortas</a>
        
        <?php if (isLogged()): ?>
            <form action="/logout" method="POST" style="display:inline">
                <button type="submit" style="background:none;border:none;color:blue;cursor:pointer;text-decoration:underline;">Logout</button>
            </form>
        <?php else: ?>
            <a href="/login">Login</a>
        <?php endif; ?>
    </nav>
</header>
>>>>>>> 584df76d791b10d803b592c89df885ec88d35a5e
