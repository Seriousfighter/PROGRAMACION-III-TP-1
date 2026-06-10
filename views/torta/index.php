<?php
$this->layout('layout', ["title" => "Tortas"])
?>

<h1>Listado de Tortas</h1>

<?php if (isLogged()): ?>
    <a href="/tortas/create">Nueva Torta</a>
<?php endif; ?>

<?php if (count($tortas) === 0): ?>
    <p>No hay tortas.</p>
<?php else: ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Sabor</th>
            <th>Cobertura</th>
            <th>Tamaño</th>
            <th>Rellenos</th>
            <th>Precio Unitario</th>
            <?php if (isLogged() && hasRole('admin')): ?>
                <th>Acciones</th>
            <?php endif; ?>
        </tr>
        <?php foreach ($tortas as $t): ?>
        <tr>
            <td><?= htmlspecialchars((string)$t->id) ?></td>
            <td><?= htmlspecialchars($t->sabor->nombre ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($t->cobertura->nombre ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($t->tamano->nombre ?? 'N/A') ?></td>
            <td>
                <?php 
                    if ($t->rellenos && count($t->rellenos) > 0) {
                        $nombresRellenos = [];
                        foreach ($t->rellenos as $r) {
                            $nombresRellenos[] = htmlspecialchars($r->nombre);
                        }
                        echo implode(', ', $nombresRellenos);
                    } else {
                        echo 'Sin relleno';
                    }
                ?>
            </td>
            <td><?= htmlspecialchars((string)$t->precio_unitario) ?></td>
            
            <?php if (isLogged() && hasRole('admin')): ?>
                <td>
                    <a href="/tortas/<?= (int)$t->id ?>/edit">Editar</a>
                    <form action="/tortas/<?= (int)$t->id ?>/delete" method="POST" style="display:inline">
                        <button type="submit" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                    </form>
                </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>