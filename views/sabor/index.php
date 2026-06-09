<?php
$this->layout('layout', ["title" => "Sabores"]) ?>
    <h1>Listado de Sabores</h1>
    
    <?php if (isLogged() && hasRole('admin')): ?>
        <a href="/sabores/create">Nuevo Sabor</a>
    <?php endif; ?>
    
    <?php if (count($sabores) === 0): ?>
        <p>No hay sabores.</p>
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
            <?php foreach ($sabores as $s): ?>
            <tr>
                <td><?= htmlspecialchars((string)$s->id) ?></td>
                <td><?= htmlspecialchars((string)$s->nombre) ?></td>
                <td><?= htmlspecialchars((string)$s->precio_extra) ?></td>
                
                <?php if (isLogged() && hasRole('admin')): ?>
                    <td>
                        <a href="/sabores/<?= (int)$s->id ?>/edit">Editar</a>
                        <form action="/sabores/<?= (int)$s->id ?>/delete" method="POST" style="display:inline">
                            <button type="submit" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>