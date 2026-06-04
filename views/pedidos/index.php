<?php $this->layout('layout', ['title' => $titulo ?? 'Pedidos']) ?>

<div class="container mt-4">
    <h1><?= htmlspecialchars($titulo ?? 'Listado de Pedidos') ?></h1>

    <a href="/pedidos/create" class="btn btn-primary mb-3">Nuevo Pedido</a>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($pedidos)): ?>
                <tr>
                    <td colspan="7" class="text-center">No hay pedidos registrados</td>
                </tr>
            <?php else: ?>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?= htmlspecialchars((string)$pedido->getId()) ?></td>
                        <td><?= htmlspecialchars($pedido->getCliente()) ?></td>
                        <td><?= htmlspecialchars($pedido->getProducto()) ?></td>
                        <td><?= htmlspecialchars((string)$pedido->getCantidad()) ?></td>
                        <td><?= htmlspecialchars($pedido->getFecha()) ?></td>
                        <td>
                            <span class="badge bg-<?= $pedido->getEstado() === 'completado' ? 'success' : ($pedido->getEstado() === 'pendiente' ? 'warning' : 'secondary') ?>">
                                <?= htmlspecialchars($pedido->getEstado()) ?>
                            </span>
                        </td>
                        <td>
                            <a href="/pedidos/<?= $pedido->getId() ?>" class="btn btn-sm btn-info">Ver</a>
                            <a href="/pedidos/<?= $pedido->getId() ?>/edit" class="btn btn-sm btn-warning">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>