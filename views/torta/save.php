<!DOCTYPE html>
<html>
<head>
    <title><?= isset($torta) ? 'Editar' : 'Nueva' ?> Torta</title>
</head>
<body>
    <h1><?= isset($torta) ? 'Editar' : 'Nueva' ?> Torta</h1>
    
    <form action="<?= isset($torta) ? '/tortas/' . (int)$torta->id . '/update' : '/tortas/store' ?>" method="POST" id="formTorta">
        
        <!-- Sabor -->
        <label>
            Sabor:
            <select name="sabor_id" id="sabor_id" required onchange="calcularPrecio()">
                <option value="">Seleccionar sabor...</option>
                <?php foreach ($sabores as $s): ?>
                    <option value="<?= (int)$s->id ?>" 
                            data-precio-extra="<?= (float)$s->precio_extra ?>"
                            <?= (isset($torta) && $torta->sabor_id == $s->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($s->nombre) ?> (+$<?= htmlspecialchars((string)$s->precio_extra) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <br><br>
        
        <!-- Cobertura -->
        <label>
            Cobertura:
            <select name="cobertura_id" id="cobertura_id" required onchange="calcularPrecio()">
                <option value="">Seleccionar cobertura...</option>
                <?php foreach ($coberturas as $c): ?>
                    <option value="<?= (int)$c->id ?>" 
                            data-precio-extra="<?= (float)$c->precio_extra ?>"
                            <?= (isset($torta) && $torta->cobertura_id == $c->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c->nombre) ?> (+$<?= htmlspecialchars((string)$c->precio_extra) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <br><br>
        
        <!-- Tamaño -->
        <label>
            Tamaño:
            <select name="tamano_id" id="tamano_id" required onchange="calcularPrecio()">
                <option value="">Seleccionar tamaño...</option>
                <?php foreach ($tamanos as $t): ?>
                    <option value="<?= (int)$t->id ?>" 
                            data-precio-base="<?= (float)$t->precio_base ?>"
                            <?= (isset($torta) && $torta->tamano_id == $t->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($t->nombre) ?> (<?= htmlspecialchars((string)$t->porciones) ?> porciones - $<?= htmlspecialchars((string)$t->precio_base) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <br><br>
        
        <!-- Rellenos (múltiples checkboxes) -->
        <fieldset>
            <legend>Rellenos (seleccioná uno o más):</legend>
            <?php 
                $seleccionados = isset($rellenosSeleccionados) ? $rellenosSeleccionados : [];
                foreach ($rellenos as $r): 
                    $checked = in_array($r->id, $seleccionados) ? 'checked' : '';
            ?>
                <label style="display: block; margin: 5px 0;">
                    <input type="checkbox" name="rellenos[]" value="<?= (int)$r->id ?>" 
                           data-precio-extra="<?= (float)$r->precio_extra ?>"
                           <?= $checked ?> onchange="calcularPrecio()">
                    <?= htmlspecialchars($r->nombre) ?> (+$<?= htmlspecialchars((string)$r->precio_extra) ?>)
                </label>
            <?php endforeach; ?>
        </fieldset>
        <br>
        
        <!-- ✅ PRECIO UNITARIO: mostrado automáticamente, NO editable -->
        <div style="padding: 10px; background: #f0f0f0; border-radius: 5px;">
            <strong>Precio Unitario Calculado:</strong>
            <span id="precioDisplay" style="font-size: 1.3em; color: #2c7;">
                $<?= isset($torta) ? number_format($torta->precio_unitario, 2) : '0.00' ?>
            </span>
            <!-- Input hidden: el backend lo calcula, esto es solo por si querés consistencia -->
            <input type="hidden" name="precio_unitario" id="precio_unitario" 
                   value="<?= isset($torta) ? (float)$torta->precio_unitario : '0' ?>">
        </div>
        <br>
        
        <button type="submit">Guardar</button>
        <a href="/tortas">Cancelar</a>
    </form>

    <script>
    function calcularPrecio() {
        let total = 0;

        // Tamaño: precio base
        const tamanoSelect = document.getElementById('tamano_id');
        const tamanoOption = tamanoSelect.options[tamanoSelect.selectedIndex];
        total += parseFloat(tamanoOption.dataset.precioBase || 0);

        // Sabor: precio extra
        const saborSelect = document.getElementById('sabor_id');
        const saborOption = saborSelect.options[saborSelect.selectedIndex];
        total += parseFloat(saborOption.dataset.precioExtra || 0);

        // Cobertura: precio extra
        const coberturaSelect = document.getElementById('cobertura_id');
        const coberturaOption = coberturaSelect.options[coberturaSelect.selectedIndex];
        total += parseFloat(coberturaOption.dataset.precioExtra || 0);

        // Rellenos: sumar extras de los checked
        document.querySelectorAll('input[name="rellenos[]"]:checked').forEach(cb => {
            total += parseFloat(cb.dataset.precioExtra || 0);
        });

        // Mostrar
        document.getElementById('precioDisplay').textContent = '$' + total.toFixed(2);
        document.getElementById('precio_unitario').value = total.toFixed(2);
    }

    // Calcular al cargar la página
    document.addEventListener('DOMContentLoaded', calcularPrecio);
    </script>
</body>
</html>