<nav>
   
    <?php if (isLogged() && hasRole('admin')) {
        echo '<a href="/ingredients/create">Crear Ingrediente</a>';
        echo '<a href="/pedidos">Ver Pedidos</a>';
    }
    ?>
    
</nav>