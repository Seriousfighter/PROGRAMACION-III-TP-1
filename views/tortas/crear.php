<?php $this->layout('layout', ['title' => 'Personalizar mi torta']) ?>

<div class="container mt-4">
    <h1>Crear Torta para Nuevo Pedido</h1>
    
    <form action="/tortas" method="POST">
        <div class="mb-3">
            <label>Cliente</label>
            <select name="usuario_id" class="form-control" required>
                <option value="">Seleccionar cliente</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id'] ?>"><?= htmlspecialchars($usuario['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label>Sabor</label>
            <select name="sabor_id" class="form-control" required>
                <?php foreach ($sabores as $sabor): ?>
                    <option value="<?= $sabor['id'] ?>"><?= htmlspecialchars($sabor['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label>Rellenos</label>
            <select name="rellenos_id[]" class="form-control" multiple size="4">
                <?php foreach ($rellenos as $relleno): ?>
                    <option value="<?= $relleno['id'] ?>"><?= htmlspecialchars($relleno['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
            <small>Ctrl + click para elegir varios</small>
        </div>
        
        <div class="mb-3">
            <label>Cobertura</label>
            <select name="cobertura_id" class="form-control">
                <option value="">Sin cobertura</option>
                <?php foreach ($coberturas as $cobertura): ?>
                    <option value="<?= $cobertura['id'] ?>"><?= htmlspecialchars($cobertura['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label>Tamaño</label>
            <select name="tamano_id" class="form-control" required>
                <?php foreach ($tamanos as $tamano): ?>
                    <option value="<?= $tamano['id'] ?>">
                        <?= htmlspecialchars($tamano['nombre']) ?> - $<?= $tamano['precio'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label>Fecha de entrega</label>
            <input type="date" name="fecha_entrega" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Crear Pedido</button>
        <a href="/pedidos" class="btn btn-secondary">Cancelar</a>
    </form>
</div>