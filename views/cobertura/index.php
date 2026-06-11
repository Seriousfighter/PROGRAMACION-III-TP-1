<?php
$this->layout('layout', ["title" => "Cobertura"]) ?>
    <h1>Listado de Coberturas</h1>
    
    <?php if (isLogged() && hasRole('admin')): ?>
        <a href="/coberturas/create">Nueva Cobertura</a>
    <?php endif; ?>
    
    <?php if (count($coberturas) === 0): ?>
        <p>No hay coberturas.</p>
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
            <?php foreach ($coberturas as $c): ?>
            <tr>
                <td><?= htmlspecialchars((string)$c->id) ?></td>
                <td><?= htmlspecialchars((string)$c->nombre) ?></td>
                <td><?= htmlspecialchars((string)$c->precio_extra) ?></td>
                
                <?php if (isLogged() && hasRole('admin')): ?>
                    <td>
                        <a href="/coberturas/<?= (int)$c->id ?>/edit">Editar</a>
                        <form action="/coberturas/<?= (int)$c->id ?>/delete" method="POST" style="display:inline">
                            <button type="submit" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>