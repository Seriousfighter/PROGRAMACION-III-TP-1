<!DOCTYPE html>
<html>
<head>
    <title>Rellenos</title>
</head>
<body>
    <h1>Listado de Rellenos</h1>
    
    <?php if (isLogged() && hasRole('admin')): ?>
        <a href="/rellenos/create">Nuevo Relleno</a>
    <?php endif; ?>
    
    <?php if (count($rellenos) === 0): ?>
        <p>No hay rellenos.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio Extra</th>
                <?php if (isLogged() && hasRole('admin')): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
            <?php foreach ($rellenos as $r): ?>
            <tr>
                <td><?= htmlspecialchars((string)$r->id) ?></td>
                <td><?= htmlspecialchars((string)$r->nombre) ?></td>
                <td><?= htmlspecialchars((string)$r->precio_extra) ?></td>
                
                <?php if (isLogged() && hasRole('admin')): ?>
                    <td>
                        <a href="/rellenos/<?= (int)$r->id ?>/edit">Editar</a>
                        <form action="/rellenos/<?= (int)$r->id ?>/delete" method="POST" style="display:inline">
                            <button type="submit" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>