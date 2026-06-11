<?php $this->layout('layout', ['title' => $titulo ?? 'Pedidos']) ?>

<div class="container mt-4">
    <h1><?= htmlspecialchars($titulo ?? 'Listado de Pedidos') ?></h1>

    <a href="/tortas/crear" class="btn btn-success mb-3">+ Nuevo Pedido (Crear Torta)</a>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha Pedido</th>
                <th>Fecha Entrega</th>
                <th>Total</th>
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
                        <td><?= htmlspecialchars((string)$pedido['id']) ?></td>
                        <td><?= htmlspecialchars($pedido['cliente_nombre'] ?? 'Usuario #' . $pedido['usuario_id']) ?></td>
                        <td><?= htmlspecialchars($pedido['fecha_pedido']) ?></td>
                        <td><?= htmlspecialchars($pedido['fecha_entrega'] ?? '-') ?></td>
                        <td>$<?= number_format($pedido['total'], 2) ?></td>
                        <td>
                            <span class="badge bg-<?= 
                                $pedido['estado'] === 'entregado' ? 'success' : 
                                ($pedido['estado'] === 'pendiente' ? 'warning' : 'info') 
                            ?>">
                                <?= htmlspecialchars($pedido['estado']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="/pedidos/<?= $pedido['id'] ?>" class="btn btn-sm btn-info">Ver</a>
                            <a href="/pedidos/<?= $pedido['id'] ?>/edit" class="btn btn-sm btn-warning">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>