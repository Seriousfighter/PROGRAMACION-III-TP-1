<header>
    <h1>Header</h1>
    <nav>
        <?php include dirname(__DIR__).'/views/UI/nav.php'; ?>
        
        <?php if (isLogged()): ?>
            <form action="/logout" method="POST" style="display:inline">
                <button type="submit" style="background:none;border:none;color:blue;cursor:pointer;text-decoration:underline;">Logout</button>
            </form>
        <?php else: ?>
            <a href="/login">Login</a>
        <?php endif; ?>
    </nav>
</header>
