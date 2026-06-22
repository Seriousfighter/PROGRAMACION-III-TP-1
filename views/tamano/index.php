<?php
$this->layout('layout', ["title" => "Tamaños"]) ?>
    <h1>Listado de Tamaños</h1>
    
    <?php if (isLogged() && hasRole('admin')): ?>
        <a href="/tamanos/create">Nuevo Tamaño</a>
    <?php endif; ?>
    
    <?php if (count($tamanos) === 0): ?>
        <p>No hay tamaños.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Porciones</th>
                <th>Precio Base</th>
                <?php if (isLogged() && hasRole('admin')): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
            <?php foreach ($tamanos as $t): ?>
            <tr>
                <td><?= htmlspecialchars((string)$t->id) ?></td>
                <td><?= htmlspecialchars((string)$t->nombre) ?></td>
                <td><?= htmlspecialchars((string)$t->porciones) ?></td>
                <td><?= htmlspecialchars((string)$t->precio_base) ?></td>
                
                <?php if (isLogged() && hasRole('admin')): ?>
                    <td>
                        <a href="/tamanos/<?= (int)$t->id ?>/edit">Editar</a>
                        <form action="/tamanos/<?= (int)$t->id ?>/delete" method="POST" style="display:inline">
                            <button type="submit" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>